<?php


namespace App\Controller;
use App\Entity\Batiment;
use App\Entity\Carte;
use App\Entity\Heroesofpixel;
use App\Entity\Personnage;
use App\Entity\Quote;
use App\Utils\Messages;
use App\Utils\Functions;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Session\Session;

class AjaxController extends AbstractController
{

    private $security;
    private $em;

    public function __construct(Security $security, EntityManagerInterface $em)
    {
        $this->security = $security;
        $this->em = $em;
    }

    public function messages()
    {

        $session = new Session();
        $user = $this->security->getUser();

        $idUser=$user->getId();

        // Pour chaque type de message, affiche si non vide
        $success = $session->getFlashBag()->get('success', []);
        if( count( $success ) > 0 ) {
            echo '<p class="success">';
            foreach ($success as $message) {
                echo  $message . '<br />';
                if($idUser!=''){
                    $rap = json_decode($user->getRapport(),true);
                    $rap['recompense'][] = $message;
                    $rap = json_encode($rap);
                    $user->setRapport($rap);
                    $this->em->persist($user);
                    $this->em->flush();
                }
            }
            echo '</p>';
        }

        $warning = $session->getFlashBag()->get('warning', []);
        if( count( $warning ) > 0 ) {
            echo '<p class="warning">';
            foreach ($warning as $message) {
                echo  $message . '<br />';
                if($idUser!=''){
                    $rap = json_decode($user->getRapport(),true);
                    $rap['recompense'][] = $message;
                    $rap = json_encode($rap);
                    $user->setRapport($rap);
                    $this->em->persist($user);
                    $this->em->flush();
                }
            }
            echo '</p>';
        }
        $error = $session->getFlashBag()->get('error', []);
        if( count( $error ) > 0 ) {
            echo '<p class="error">';
            foreach ($error as $message) {
                echo  $message . '<br />';
                if($idUser!=''){
                    $rap = json_decode($user->getRapport(),true);
                    $rap['recompense'][] = $message;
                    $rap = json_encode($rap);
                    $user->setRapport($rap);
                    $this->em->persist($user);
                    $this->em->flush();
                }
            }
            echo '</p>';
        }
        die();
    }

    public function replaceRepresentants(){
        $persos  = $this->em->getRepository(Personnage::class);
        $persos->mouveSalle(5, 17);
        $persos->mouveSalle(6, 18);
        $persos->mouveSalle(7, 19);
        $persos->mouveSalle(8, 20);
        die();
    }

    public function majheure(Request $request)
    {

        $user       = $this->em->getRepository(User::class);

        $message='';
        $attentatNb=0;
        $defaite = 0;


        $jours=$user->majHeure($request->get('cleHeure'), $request->get('heure'));
        $messageRebellion = $jours[1];
        $jours = $jours[0];
        $us = $this->security->getUser();

        $persoHeure  = $this->em->getRepository(Personnage::class);
        $carte       = $this->em->getRepository(Carte::class);

        $clsImg=$us->getImpot();if($clsImg>5)$clsImg=5;

       // echo '<p>'.$jours.' jours</p>:::'.$us->getEpice();

        if($us->getSoin()>=$us->getDelaiAttentat()){//si soin superieur ou egal a 2 jours : risque d'attentat
            $num=rand(0, 10);
             //$num=6;//A COMMENTER APRES LES TESTS !!!

            if($num>5){		//attentat

                $num=rand(1, $us->getNbVictime());//fix
                $faction=rand(3, 6);
                // $faction=5;//fix

                if($user->getServiteurFaction($faction)!=0 || $user->getEscorteFaction($faction)!=0){

                    $user->majEscorte(-$num, $faction, 1);//tue ET les serviteurs ET les gardes
                    $factionName=$persoHeure->getFaction($faction);
                    if($num==1)
                        $phrase=' mort est à déplorer';
                    else
                        $phrase=' morts sont à déplorer';
                    $message='Un attentat a été commis sur la maison '.$factionName.'. '.$num.$phrase.'<br/>';
                    $defaite = 1;
                    $attentatNb = 1;
                    //Messages::setWarningMessage($message);
                }

                $us->setSoin(0);
                $this->em->persist($us);
                $this->em->flush();
            }

        }
        if($us->getSoin() < $us->getDelaiAttentat() && ( $request->get('cleHeure') == 0 || $request->get('cleHeure') == 45 )){
            ////////////attaque carte

            $planPossess=$carte->getMyStars(1);
            $plan=$carte->getAllStar();
            if( count($planPossess) > 3 ){ //n'attaque pas en dessous de trois planetes
                $nb=rand(0, count($plan)-1);
                //$myS=$carte->getMyStar($plan[5]['ca_id']);//klingonXII
                $myS=$carte->getMyStar($plan[$nb]['ca_id']);
                if(isset($myS['cau_etat']) && $myS['cau_etat']==1 && $myS['cau_diplomate']==0){
                    $troupes=$myS['cau_troupe'];
                    $pirates=rand(25, 250);
                    $res=$troupes-$pirates;
                    if($res<0)$res=0;
                    if($res==0){
                        $carte->deletePlanete($myS['ca_id']);
                        $defaite = 1;
                        $message.='La planète '.$myS['ca_nom'].' a été attaquée par '.$pirates.' pirates. Nous avons perdu la planète<br/> - 200 <img src="/images/credit.png" title="credit" /><br/>';
                        $user->majCredit(-200);
                        ?><script>afficheSpice();</script><?php
                    }else{
                        $defaite = 0;
                        $carte->setTroupes($myS['ca_id'], $res);
                        $message.='La planète '.$myS['ca_nom'].' a été attaquée par '.$pirates.' pirates. Nous avons gagné la bataille<br/>';
                    }
                }
            }
            ////////////fin attaque carte
        }


        if( $messageRebellion != '')
            $message .= $messageRebellion;
        if($message!=''){
            if( $defaite == 1 )
                Messages::setWarningMessage($message);
            else
                Messages::setSuccessMessage($message);
           /* ?><script>recompenseDisplay('<?php echo $message;?>');*/
           if( $attentatNb ==1 )echo '<script>afficheGraphe();</script>';

        }

        if(5-$clsImg==0)
            echo '<p>'.$jours.' jours <span title="Cérémonie du Partage imminente" class="delais_'.$clsImg.'"></span></p>:::'.sprintf("%05d", $us->getEpice()).':::'.sprintf("%04d", $us->getRenommee()).':::'.sprintf("%04d", $us->getEau()).':::'.sprintf("%04d", $us->getCredit()).':::'.$us->getTroupe().':::'.$us->getServiteur().':::'.$us->getInfluence().':::'.$us->getGardien();
        else
            echo '<p>'.$jours.' jours <span title="Prochaine Cérémonie du Partage : '.(5-$clsImg).' jours" class="delais_'.$clsImg.'"></span></p>:::'.sprintf("%05d", $us->getEpice()).':::'.sprintf("%04d", $us->getRenommee()).':::'.sprintf("%04d", $us->getEau()).':::'.sprintf("%04d", $us->getCredit()).':::'.$us->getTroupe().':::'.$us->getServiteur().':::'.$us->getInfluence().':::'.$us->getGardien();

        die();

    }

    public function ajaxporte(Request $request) {

        $persos   =    $this->em->getRepository(Personnage::class);

        $idPorte	=	$request->query->get('porte');
        $etat	=	$request->query->get('etatPorte');
        $idObject	=	$request->query->get('objectId');

        $persos->majPorte($idPorte, $etat);
        $persos->deleteobject($idObject);
        die();
    }

    public function journal()
    {
        $idSalle=36;

        $us     =    $this->security->getUser();
        $quetes   =    $this->em->getRepository(Quote::class);
        $cartes   =    $this->em->getRepository(Carte::class);
        $persos   =    $this->em->getRepository(Personnage::class);
        $batiments   =    $this->em->getRepository(Batiment::class);
        $heroesofpixel   =    $this->em->getRepository(Heroesofpixel::class);
        //TODO BATIMENT

        //NE FAIRE APPARAITRE DANS LE JOURNAL QU'APRES AVOIR VUR LE POLITOLOGUE
        if( $quetes->getMajQuete(7, 24, 2 ) )
            $nbEnnemis = $heroesofpixel->getNbEnnemies();
        else
            $nbEnnemis = -1;

        $nomSalle=$persos->getSalle($idSalle);
        $nomSalleU=$persos->getSalle($us->getSalle());
        $getJournal=json_decode($us->getRapport());
        $encoursExploration=$cartes->getActionVaisseau(4);//4==exploration
        $encoursAttaque=$cartes->getActionVaisseau(3);//3==attaque
        $myPlanetes=$cartes->getMyStars();

        $epice = 0;
        $eau = 0;
        $credit = 0;
        $renommee = 0;
        $troupe = 0;

        $ressourcesBatiments = $batiments->getRessources();
        foreach ($ressourcesBatiments as $ressourceBat) {
            if( $us->getEpice() + $ressourceBat['epice'] < 0 ||
                $us->getRenommee() + $ressourceBat['renommee'] < 0 ||
                $us->getEau() + $ressourceBat['eau'] < 0 ||
                $us->getCredit() + $ressourceBat['credit'] < 0 ||
                $us->getTroupe() + $ressourceBat['troupe'] < 0
            )
                continue;

            $epice +=  $ressourceBat['epice'];
            $renommee +=  $ressourceBat['renommee'];
            $eau +=  $ressourceBat['eau'];
            $credit +=  $ressourceBat['credit'];
            $troupe +=  $ressourceBat['troupe'];
        }


        return $this->render('ajax/journal.html.twig',
            [
                'salle'             => $nomSalle,
                'nomSalleU'    => $nomSalleU,
                'getJournal'    => $getJournal,
                'encoursExploration'    => $encoursExploration,
                'encoursAttaque'    => $encoursAttaque,
                'myPlanetes'    => $myPlanetes,
                'nbEnnemis'    => $nbEnnemis,
                'eau'           => $eau,
                'renommee'      => $renommee,
                'epice'           => $epice,
                'credit'           => $credit,
                'troupe'           => $troupe,
            ]);
    }

    public function journaldelete()
    {
        $us     =    $this->security->getUser();
        $us->setRapport('');
        $this->em->persist($us);
        $this->em->flush();
        die();
    }

    public function journaladd(Request $request)
    {
        $user = $this->security->getUser();

        $idUser = $user->getId();

        $message	=	$request->query->get('htmlCell');
        $message	=	str_replace("<tr>", '<br>', $message);
        $message	=	str_replace("</tr>", '', $message);
        $message	=	str_replace("<td>", '<br>', $message);
        $message	=	str_replace("</td>", '', $message);


        $rap = json_decode($user->getRapport(),true);
        $rap['recompense'][] = $message;
        $rap = json_encode($rap);
        $user->setRapport($rap);

        $this->em->persist($user);
        $this->em->flush();

        die();
    }
    public function hormones()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $persos       = $this->em->getRepository(Personnage::class);
            $persos->deleteobject(3);
        $quotes->majQuete(3, 12, 1);
        die();
    }

    public function tournevis()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $persos       = $this->em->getRepository(Personnage::class);
        $persos->deleteobject(5);
        $quotes->majQuete(1, 17, 1);

        die();
    }

    public function indice()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $persos       = $this->em->getRepository(Personnage::class);
        if( !$persos->getObjet(6) ) {
            $persos->addObjet(6);
            $quotes->majQuete(5, 6, 1);
            Messages::setSuccessMessage('Vous avez trouvé une lettre');
        }
        die();
    }

    public function inscrit()
    {
        $quotes       = $this->em->getRepository(Quote::class);

            $sucre= $quotes->getMajQuete(3, 16, 1);
            if($sucre){
                $quotes->majQuete(3, 3, 4);
                $quotes->majQuete(4, 16, 1);
                Messages::setSuccessMessage('Vous avez trouvé l\'inscription entière');
            }
        die();
    }

    public function journalprisonnier()
    {

        $persos       = $this->em->getRepository(Personnage::class);
        $quotes       = $this->em->getRepository(Quote::class);
        $livre        = $quotes->getMajQuete(1, 28, 1);
        if(!$livre){
            $persos->addObjet(21);
            Messages::setSuccessMessage('Vous avez trouvé le journal des prisonniers');
            $quotes->majQuete(1, 28, 1);
        }
        die();
    }

    public function marquepage()
    {
        $persos       = $this->em->getRepository(Personnage::class);
        $quotes       = $this->em->getRepository(Quote::class);
        $persos->addObjet(22);
        $quotes->majQuete(4, 28, 1);
        $quotes->majQuete(4, 27, 2);
        Messages::setSuccessMessage('Vous avez trouvé un marque-page');

        die();
    }


    public function chakobsa()
    {
        $persos       = $this->em->getRepository(Personnage::class);
        $quotes       = $this->em->getRepository(Quote::class);
        $persos->deleteobject(9);
        $quotes->majQuete(2, 21, 2);
        die();
    }


    public function killserrure()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $livre=$quotes->majQuete(1, 28, 9);
        die();
    }

    public function clecouloircachot()
    {
        $persos       = $this->em->getRepository(Personnage::class);
        $quotes       = $this->em->getRepository(Quote::class);

        $persos->deleteobject(20);
        $quotes->majQuete(1, 27, 9);
        die();
    }


    public function clecouloircachottake()
    {
        $persos       = $this->em->getRepository(Personnage::class);
        $quotes       = $this->em->getRepository(Quote::class);
        $persos->addObjet(20);
        $quotes->majQuete(3, 27, 2);
        Messages::setSuccessMessage('Vous avez trouvé une Clef');
        die();
    }

    public function killrat()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $quotes->majQuete(2, 27, 2);
        die();
    }

    public function livre()
    {

        $quotes       = $this->em->getRepository(Quote::class);
        $persos       = $this->em->getRepository(Personnage::class);
        $livre=$quotes->getMajQuete(4, 27, 1);
        if($livre){
            $persos->addObjet(19);
            Messages::setSuccessMessage('Vous avez trouvé le livre de Keolo');
            $quotes->majQuete(5, 27, 1);
        }
        die();
    }

    public function ajaxquote(Request $request)
    {
        //UTILISES EN BDD
        $quotes            = $this->em->getRepository(Quote::class);
        $persos            = $this->em->getRepository(Personnage::class);
        $cartes            = $this->em->getRepository(Carte::class);
        $users             = $this->em->getRepository(User::class);
        $heroesofpixel     = $this->em->getRepository(Heroesofpixel::class);

        $functions    = new Functions($this->em, $this->security);

        $user = $this->security->getUser();

        $language = (object) [
            'lang' => 'fr'
        ];
        //UTILISES EN BDD

        $valReturn='';
        $valReturn2='';
        $talk=  $request->query->get('talk');
        $xy=    $request->query->get('XY');

        if(!$xy)
            $xy=0;

        $stopTalk                 =   $request->query->get('stopTalk');
        $idPerso                  =   $request->query->get('idPerso');
        $idDiv                    =   $request->query->get('idDiv');
        $repns                    =   $request->query->get('repns');
        $idResponseUserParam      =   $request->query->get('idResponseUserParam');
        $idResponseIdExt          =   $request->query->get('idResponseIdExt');
        $majourquest              =   $request->query->get('majourquest');
        $idMultiple               =   $request->query->get('idMultiple');
        $nbMultiple               =   $request->query->get('nbMultiple');
        $rec_multiParam           =   $request->query->get('rec_multiParam');
        $rec_nb_multiParam        =   $request->query->get('rec_nb_multiParam');
        $extIdResponseUnique      =   $request->query->get('extIdResponseUnique');
        $response                 =   $request->query->get('response');



        if(isset( $majourquest ) && $majourquest !=0){
            $quotes->majQuete($majourquest, $idResponseUserParam, $idResponseIdExt);
            $fnc=$quotes->recompense($majourquest, $idResponseUserParam, $idResponseIdExt);
            if($fnc['function']!='')
                eval($fnc['function']);
            if($fnc['display']){
                ?><script>recompenseDisplay('<?php echo $fnc['display'];?>')</script><?php
            }
        }
        if($idMultiple != 0)
            $quotes->majMultiple($idMultiple, $nbMultiple);

        if($rec_multiParam != 0){
            $mfnc=$quotes->multiRecompense($rec_multiParam, $rec_nb_multiParam);
        }
        if( isset($mfnc['function']) && $mfnc['function']!='')
            eval($mfnc['function']);
        if( isset($mfnc['display']) && $mfnc['display']) {
            ?><script>recompenseDisplay('<?php echo $mfnc['display'];?>')</script><?php
        }

        if(isset($extIdResponseUnique) && $extIdResponseUnique!=0)
            $quotes->putArretQuoteMoneo($extIdResponseUnique);

        if($response!=999){
            if($repns)$response=$repns;
            if(!isset($response))
                $quoteRendu=$quotes->getQuoteByPerso($idPerso);
            else
                $quoteRendu=$quotes->getQuoteById($response);
            //print_r($quoteRendu);die();
            //if($language->lang=='en')//RECUPERER LA LANGUE
             //   $text=$quoteRendu['quo_quote_en'];
            //else
                $text=$quoteRendu['quo_quote'];

            eval($quoteRendu['quo_fnctn']);

            $maj=$quoteRendu['quo_maj_quete'];
            if($maj){
                $quotes->majQuete($maj, $quoteRendu['quo_maj_quete_perso'], $quoteRendu['quo_maj_quete_id_ext']);
                $fnc=$quotes->recompense($maj, $quoteRendu['quo_maj_quete_perso'], $quoteRendu['quo_maj_quete_id_ext']);
                if($fnc['function']!='')
                    eval($fnc['function']);
                if($fnc['display']&& !isset($stopDisplay)){
                    ?><script>recompenseDisplay('<?php echo $fnc['display'];?>')</script><?php
                }
            }
            if($quoteRendu['quo_id_multiple'] != 0)
                $quotes->majMultiple($quoteRendu['quo_id_multiple'],$quoteRendu['quo_nb_multiple']);

            if($quoteRendu['quo_recompense_multi'] != 0){
                $mfnc=$quotes->multiRecompense($quoteRendu['quo_recompense_multi'],$quoteRendu['quo_recompense_nb_multi']);/*?><script>afficheGraphe()</script><?php */
            }

            if(isset($mfnc['function']) && $mfnc['function']!='')
                eval($mfnc['function']);
            if(isset($mfnc['display']) && $mfnc['display']){
                ?><script>recompenseDisplay('<?php echo $mfnc['display'];?>')</script><?php
            }


            if($quoteRendu['quo_reponse']!= -1)
                $responsePerso=$quotes->getReponsePerso($idPerso);

            if( isset($responsePerso) && count($responsePerso) > 0 ){

                $val=1;
                $choix=1;
                foreach($responsePerso as $value){
                    $stop=0;
                    if($value['mon_fnctn']!='')
                        eval($value['mon_fnctn']);
                    if($stop==1)continue;
                    if(isset($value['ext_arret']) && $value['ext_arret']==1)
                        $extIdReponse=$value['ext_id'];
                    else
                        $extIdReponse=0;

                    if($val%2) $classD="pair";else $classD="impair";
                    //if($language->lang=='en')
                    //    $value['mon_quote']=addslashes($value['mon_quote_en']);
                    //else
                        $value['mon_quote']=addslashes($value['mon_quote']);
                    if($value['mon_reponse']==-1){
                        $value['mon_reponse']=999;

                        $valReturn2.='<p class="rp'.$value['mon_reponse'].' '.$classD.'"><a onclick="ajaxReturn(\\\''.$idDiv.'\\\', '.$value['mon_maj_quete'].', '.$value['mon_reponse'].', \\\''.$idPerso.'\\\',\\\''.$talk.'\\\', \\\''.$stopTalk.'\\\', \\\''.$value['mon_maj_quete_id_ext'].'\\\', \\\''.$value['mon_maj_quete_perso'].'\\\', \\\''.$extIdReponse.'\\\', \\\''.$value['mon_recompense_multi'].'\\\', \\\''.$value['mon_recompense_nb_multi'].'\\\');return false">'.$value['mon_quote'].'</a></p>';
                    }else
                        $valReturn.='<p class="rp'.$value['mon_reponse'].' '.$classD.'"><a onclick="ajaxReturn(\\\''.$idDiv.'\\\', '.$value['mon_maj_quete'].', '.$value['mon_reponse'].', \\\''.$idPerso.'\\\',\\\''.$talk.'\\\', \\\''.$stopTalk.'\\\', \\\''.$value['mon_maj_quete_id_ext'].'\\\', \\\''.$value['mon_maj_quete_perso'].'\\\', \\\''.$extIdReponse.'\\\', \\\''.$value['mon_recompense_multi'].'\\\', \\\''.$value['mon_recompense_nb_multi'].'\\\');return false">'.$value['mon_quote'].'</a></p>';

                    $val++;
                }
                $valReturn.=$valReturn2;
            }else
                $choix=0;

            $pieces = explode("///", $text);
            ?><div id='textoLink'><div id='textoIn'>
                    <?php
                    echo $pieces[0];
                    ?>
                </div></div>
            <div id='triangle'></div>
            <input type='hidden' id='stepDial' value='0'/>
            <?php if(count($pieces)>1){
                ?>
                <input type='hidden' id='closeWindow' value='0'/>
            <?php }else{ ?>
                <input type='hidden' id='closeWindow' value='1'/>
            <?php } ?>
            <input type='hidden' id='maxDial' value='<?php echo count($pieces);?>'/>


            <SCRIPT language="Javascript">
                $("#texto").visible();
                var idPerso='<?php echo $idDiv;?>';
                var talk='<?php echo $talk;?>';
                $("#texto").css('background-color', '#FFFFFF');
                $("#textoLink").click(function() {


                    var tab = <?php echo json_encode($pieces); ?>;
                    $("#textoIn").empty();
                    var newVal=$("#stepDial").val();
                    if(newVal < $("#maxDial").val()){
                        newVal=parseInt(newVal)+1;
                        $("#stepDial").val(newVal);

                        $("#textoIn").html(tab[newVal]);
                    }

                    if(newVal==$("#maxDial").val()-2)
                        $("#texto").addClass('lastBulle');


                    if(newVal+1==$("#maxDial").val()){
                        $("#textoLink").hide();
                        $("#closeWindow").val(1);
                        $("#texto").removeClass('lastBulle');
                        if( $('#waitRecompense').val() == 1 ){
                            $("#checkMessage").prop( "checked", true );
                            $('#waitRecompense').val(0);
                        }

                    }

                })

                $("#texto").click(function() {

                    if($("#closeWindow").val()==1){
                        arrestation = 1;

                        $("#"+idPerso).stopTime().<?php echo $talk;?>;
                        if(<?php echo $choix;?>!=0 && $('#onAutoTalk').val()==0){
                            $("#onMyTalk").val(1);
                            $("#mesTexto").addClass('conversation');
                            $("#mesTexto").html('<?php echo $valReturn;?>');
                        }else{
                            $("#onTalk").val(0);
                            $("#onMyTalk").val(0);
                            $("#mesTexto").empty();
                            $("#mesTexto").removeClass('conversation');
                            $('#yeuxMouve').val(0);
                            $('#onAutoTalk').val(0);
                            var plan=$("#plan").val();
                            $("#mesTexto").html('<img src="/images/plan/'+plan+'.png" />');
                        }
                        $("#texto").invisible();
                    }
                })

                function ajaxReturn(idDivRecu, magquest, clefId, idPersoReturn, stopTalkReturn, stopstopTalkReturn, idResponseExt, idResponseUser, extIdReponse, idMul, nbMul, rec_multi, rec_nb_multi){
                    if(clefId==999){
                        if('<?php echo $xy;?>'==1){
                            $('#yeuxMouve').val(0);
                        }
                        $("#mesTexto").removeClass('conversation');
                        $("#mesTexto").empty();
                        $("#onTalk").val(0);
                        $("#onMyTalk").val(0);
                        var plan=$("#plan").val();
                        $("#mesTexto").html('<img src="/images/plan/'+plan+'.png" />');
                        var request2 = $.ajax({
                            url: "/ajaxquote",
                            type: "GET",
                            data: {majourquest: magquest, idDiv: idDivRecu, response: clefId, idPerso: idPersoReturn, talk: stopTalkReturn,
                                stopTalk: stopstopTalkReturn, idResponseIdExt: idResponseExt, extIdResponseUnique: extIdReponse, idResponseUserParam: idResponseUser, idMultiple: idMul,
                                nbMultiple: nbMul, rec_multiParam: rec_multi, rec_nb_multiParam: rec_nb_multi},
                        });

                        return false;

                    }
                    arrestation = 1;
                    var execute = '$("#"+idPerso).stopTime().'+stopstopTalkReturn;
                    eval(execute);
                    var request2 = $.ajax({
                        url: "/ajaxquote",
                        type: "GET",
                        data: {majourquest: magquest, idDiv: idDivRecu, response: clefId, idPerso: idPersoReturn, talk: stopTalkReturn,
                            stopTalk: stopstopTalkReturn, idResponseIdExt: idResponseExt, extIdResponseUnique: extIdReponse, idResponseUserParam: idResponseUser, idMultiple: idMul,
                            nbMultiple: nbMul, rec_multiParam: rec_multi, rec_nb_multiParam: rec_nb_multi},
                    });
                    request2.done(function(msg) {
                        $("#texto").html(msg);
                    });

                }


            </SCRIPT>
            <?php
        }

        die();
    }

    public function achatobjet(Request $request)
    {
        $us = $this->security->getUser();
        $nbAchete	=	$request->query->get('nbAchete');
        $idOb	=	$request->query->get('idObParam');
        $user   = $this->em->getRepository(User::class);
        $persos   = $this->em->getRepository(Personnage::class);
        $quetes   = $this->em->getRepository(Quote::class);

            $deja		= 0;
            $dejaAchete = $us->getObjets();
            if($dejaAchete!=''){
                $dejaAchete = json_decode($dejaAchete);
                $key = array_search($idOb, $dejaAchete);
                if($key!==false)$deja = 1;
            }

            $prix=$nbAchete;
            if($prix>$us->getEpice()){
                Messages::setWarningMessage('Vous ne possédez pas assez d\'épice pour faire cet achat !');
            }
            elseif($deja==1){
                Messages::setWarningMessage('Vous avez déjà acheté ce type d\'objet !');
            }
            else{
                $user->majEpice(-$prix);
                $user->majObjet($idOb);//au customer pour qu'il ne puisse pas acheter deux fois le même objet

                $persos->addObjet($idOb);
                $ob = $persos->getNameObjet($idOb);
                Messages::setSuccessMessage('Vous avez acheté un '.$ob);
                if($idOb==7)
                    $quetes->majQuete(1, 10, 1);
                echo 'done';
            }

            die();
    }

    public function achatvaisseau(Request $request)
    {
        $us = $this->security->getUser();
        $nbAchete	=	$request->query->get('nbAchete');
        $user   = $this->em->getRepository(User::class);
        $cartes   = $this->em->getRepository(Carte::class);

            if($nbAchete == 1 || $nbAchete == 2 || $nbAchete == 5 || $nbAchete == 10){

                $getActionVaisseau=$cartes->getActionVaisseau(3);
                $prix=$nbAchete*$us->getValeurVaisseau();
                if($prix>$us->getEpice()){
                    Messages::setWarningMessage('Vous ne possédez pas assez d\'épice pour faire cet achat !');
                }
                elseif($getActionVaisseau>0){
                    Messages::setWarningMessage('Vous ne pouvez pas acheter de vaisseaux lorsque votre flotte est en	expédition !');
                }
                else{
                    $user->majEpice(-$prix);
                    $user->majVaisseau($nbAchete);
                    echo $us->getVaisseau()+$nbAchete;
                    Messages::setSuccessMessage('Vous avez acheté '.$nbAchete.' vaisseaux !');
                }
            }
            die();
    }

    public function ajaxusermaj(Request $request)
    {
        $idCell	=	$request->query->get('idCell');
        $user   = $this->em->getRepository(User::class);


        switch ($idCell) {
            case 'IXinfluence':
                $user->majuserinfluence(5);
                $image='influence';
                $result=$user->getInfluenceFaction(5);
                break;
            case 'IXserviteur':
                $user->majuserServiteur(5);
                $image='serviteur';
                $result=$user->getServiteurFaction(5);
                break;
            case 'IXescorte':
                $user->majuserEscorte(5);
                $image='escorte';
                $result=$user->getEscorteFaction(5);
                break;
            case 'GUILDEinfluence':
                $user->majuserinfluence(6);
                $image='influence';
                $result=$user->getInfluenceFaction(6);
                break;
            case 'GUILDEserviteur':
                $user->majuserServiteur(6);
                $image='serviteur';
                $result=$user->getServiteurFaction(6);
                break;
            case 'GUILDEescorte':
                $user->majuserEscorte(6);
                $image='escorte';
                $result=$user->getEscorteFaction(6);
                break;
            case 'TLEILAXinfluence':
                $user->majuserinfluence(4);
                $image='influence';
                $result=$user->getInfluenceFaction(4);
                break;
            case 'TLEILAXserviteur':
                $user->majuserServiteur(4);
                $image='serviteur';
                $result=$user->getServiteurFaction(4);
                break;
            case 'TLEILAXescorte':
                $user->majuserEscorte(4);
                $image='escorte';
                $result=$user->getEscorteFaction(4);
                break;
            case 'GUESSERITinfluence':
                $user->majuserinfluence(3);
                $image='influence';
                $result=$user->getInfluenceFaction(3);
                break;
            case 'GUESSERITserviteur':
                $user->majuserServiteur(3);
                $image='serviteur';
                $result=$user->getServiteurFaction(3);
                break;
            case 'GUESSERITescorte':
                $user->majuserEscorte(3);
                $image='escorte';
                $result=$user->getEscorteFaction(3);
                break;
        }
        if($image=='serviteur')echo '<script>afficheGraphe()</script>';
        $img=$image;
        $result=$result;

        return $this->render('ajax/ajaxusermaj.html.twig',
            [
                    'img' => $img,
                    'result' => $result
            ]);
    }

    public function ajaxusersugg(Request $request)
    {
        $idSlider	=	$request->get('idSlider');
        $valueSlid	=	$request->get('valueSlid');

        $user   = $this->em->getRepository(User::class);
        if($idSlider=='sliIx')$idFaction=5;
        elseif($idSlider=='sliTl')$idFaction=4;elseif($idSlider=='sliBEN')$idFaction=3;else $idFaction=6;
        $user->majSuggestionFaction($idFaction, $valueSlid);

        die();

    }

    public function ajaxpaye()
    {
        $quotes       = $this->em->getRepository(Quote::class);
        $persos       = $this->em->getRepository(Personnage::class);
        $cartes       = $this->em->getRepository(Carte::class);
        $users        = $this->em->getRepository(User::class);
        $language = (object) [
            'lang' => 'fr'
        ];

        $functions    = new Functions($this->em, $this->security);

        $user = $this->security->getUser();


        $arrSuggestion=$users->getSuggestionFaction();
        $arrInfluence=$users->getAllInfluence();
        $epiceVoulu1=array(20=>rand(0, 99), 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(2000, 4000), 100=>rand(5000, 8000));
        $epiceVoulu2=array(20=>rand(0, 99), 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(2000, 4000), 100=>rand(5000, 8000));
        $epiceVoulu3=array(20=>rand(0, 99), 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(2000, 4000), 100=>rand(5000, 8000));
        $epiceVoulu4=array(20=>rand(0, 99), 40=>rand(100, 500), 60=>rand(500, 1000), 80=>rand(2000, 4000), 100=>rand(5000, 8000));
        $renommeeVoulu=array(20=>0, 40=>100, 60=>150, 80=>300, 100=>500);
        $corruptionVoulu=array(20=>1, 40=>0, 60=>0, 80=>0, 100=>0);//Si on choisit de ne pas donner d'epice a une maison

        $myEpice=$user->getEpice();
        $usCorr=$user->getCorruption();

        $epiceIx=$epiceVoulu1[$arrSuggestion[5]]-($arrInfluence[5]*10);
        $epiceGuilde=$epiceVoulu2[$arrSuggestion[6]]-($arrInfluence[6]*10);
        $epiceTleilax=$epiceVoulu3[$arrSuggestion[4]]-($arrInfluence[4]*10);
        $epiceGuesserit=$epiceVoulu4[$arrSuggestion[3]]-($arrInfluence[3]*10);
        $corrupTotal=$corruptionVoulu[$arrSuggestion[3]]+$corruptionVoulu[$arrSuggestion[4]]+$corruptionVoulu[$arrSuggestion[5]]+$corruptionVoulu[$arrSuggestion[6]];
        $corruptionVoulu=$corrupTotal;
        $renommeeGagnee=$renommeeVoulu[$arrSuggestion[3]]+$renommeeVoulu[$arrSuggestion[4]]+$renommeeVoulu[$arrSuggestion[5]]+$renommeeVoulu[$arrSuggestion[6]];
        $suggIx=$arrSuggestion[5];
        $suggGuilde=$arrSuggestion[6];
        $suggTleilax=$arrSuggestion[4];
        $suggGuesserit=$arrSuggestion[3];

        if($language->lang=='en')
            $this->render('ajax/ajaxpaye-en.phtml');

        return $this->render('ajax/ajaxpaye.html.twig',
            [
                'myEpice' => $myEpice,
                'usCorr' => $usCorr,
                'epiceIx' => $epiceIx,
                'epiceGuilde' => $epiceGuilde,
                'epiceTleilax' => $epiceTleilax,
                'epiceGuesserit' => $epiceGuesserit,
                'corrupTotal' => $corrupTotal,
                'corruptionVoulu' => $corruptionVoulu,
                'renommeeGagnee' => $renommeeGagnee,
                'suggIx' => $suggIx,
                'suggGuilde' => $suggGuilde,
                'suggTleilax' => $suggTleilax,
                'suggGuesserit' => $suggGuesserit,
            ]);


    }

    public function ajaximpot(Request $request){

        $user   = $this->security->getUser();
        $quotes = $this->em->getRepository(Quote::class);
        $users = $this->em->getRepository(User::class);

        $idUser = $user->getId();

        $message	=	$request->query->get('htmlCell');

        $epice	=	$request->query->get('epice');
        $renommee	=	$request->query->get('renommee');
        $corruption	=	$request->query->get('corruption');
        $suggGuesserit	=	$request->query->get('suggGuesserit');
        $suggIx	=	$request->query->get('suggIx');
        $suggGuilde	=	$request->query->get('suggGuilde');
        $suggTleilax	=	$request->query->get('suggTleilax');
        $corruptionTotale	=	$request->query->get('corruptionTotale');

        $menace= $quotes->getMajQuete(5, 7, 1);
        if($menace && $suggIx==20)
            $quotes->majQuete(7, 7, 1);

        $users->majEpice($epice);
        $users->majCredit(round($renommee-($corruptionTotale*150)));
        $users->majCorruption($corruption);
        $users->majImpot();
        die();
    }

    public function addObject(Request $request)
    {
        $idObjet = $request->query->get('idObjet');
        $message = $request->query->get('message');
        $personnage = $this->em->getRepository(Personnage::class);
        if( !$personnage->getObjet($idObjet) ) {
            $personnage->addObjet($idObjet);
            Messages::setSuccessMessage($message);
        }
			die();
    }

    public function opensafe(Request $request)
    {
        $idObjet = $request->query->get('objectId');
        $personnage = $this->em->getRepository(Personnage::class);
        $quotes = $this->em->getRepository(Quote::class);
        $quotes->majQuete(2, 30, 3);
        $personnage->deleteobject($idObjet);
			die();
    }

    public function killsafe(Request $request)
    {
        $quotes = $this->em->getRepository(Quote::class);
        $quotes->majQuete(3, 30, 3);
			die();
    }

    public function majquete(Request $request)
    {
        $idQuete = $request->query->get('idQuete');
        $idPerso = $request->query->get('idPerso');
        $idExterne = $request->query->get('idExterne');
        $message = $request->query->get('message');

        $quotes = $this->em->getRepository(Quote::class);
        $quotes->majQuete($idQuete, $idPerso, $idExterne);

        if( $message != '')
            Messages::setSuccessMessage($message);
			die();
    }
}
