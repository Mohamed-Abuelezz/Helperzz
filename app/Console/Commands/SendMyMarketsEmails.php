<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\DashboardMail;
use App\Models\Order;

class SendMyMarketsEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is for send to markiting emails';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {


        //Order::query()->delete();


        $emails = [
            "abumazenn@hotmail.com",
            "a700r@hotmail.com",
            "jameel_saleem2000@yahoo.c",
            "k2223222@hotmail.com",
            "macgyver_saker@yahoo.com",
            "first_job_online@yahoo.co",
            "sh_shot@yahoo.com", "reem12@hotmail.fr",
            "rawanrim@wanadoo.jo", "catcato2000@yahoo.com", "smsm_m10@yahoo.com", "asalfm@yahoo.com", "rrcoom@hotmail.com", "www.alrashed91@hotmail.co", "thepinkcandy@hotmail.com", "blektygr@yahoo.com", "khaled-zayed@hotmail.com", "king44u@hotmail.com", "hudaalahmad@yahoo.com", "madina_102@msn.com", "nowaf77_7@hotmail.com", "oussa_offer@hotmail.com", "fonoon_net@hotmail.com", "lmzn2000@yahoo.com", "shiakhi@hotmail.com", "almadhoun2005@yahoo.com", "esgr66@yahoo.com", "skymoons26@yahoo.com", "starland@maktoob.com", "friends_company7@yahoo.co", "egcmedia@hotmail.com", "amr_apple@hotmail.com", "halakagroup@hotmail.com", "alrazaz999@yahoo.com", "atalla2007@hotmail.com", "osama_1000@hotmail.com", "kien123-ali@hotmail.com", "f2005f2005@hotmail.com", "al-faiq@maktoob.com", "t8831@hotmail.com", "s_deeb7@yahoo.com", "noursakr@eim.ae", "coco2002d@yahoo.com", "lovee5544@hotmail.com", "zizi_moe@hotmail.com", "emsom1@hotmail.com", "dubaivip12@hotmail.com", "aqaz2@hotmail.com", "najjar_group@yahoo.com", "mogha01@hotmail.com", "monasseq_awqal@yahoo.cm", "miss_oman81@hotmail.com", "sara.121@hotmail.com", "abdd85@maktoob.com", "katheer2@hotmail.com", "hanawye@hotmail.com", "kollaga@hotmail.com", "ebcobassili@yahoo.co.uk", "nour_hanz@yahoo.com", "pc_group@yahoo.com", "nhm11@hotmail.com", "work4us@onyxhome.com", "info@arabharaj.com", "p27062@yahoo.com", "thjdf@hotmail.com", "vigor151@hotmail.com", "best_home_job@yahoo.com", "alsha56@hotmail.com", "ahmed_roiaa2010@yahoo.com", "mohamed_hafez1967@yahoo.c", "rihamfathy@gmail.com", "dayl_2003@hotmail.com", "sami_khayat@hotmail.com", "b_911_b@hotmail.com", "khamis_mms@hotmail.com", "mo2mna976_2006@yahoo.com", "salodin966@yahoo.com", "king_666@w.cn", "hayel_sh@hotmail.com", "sasatop2006@hotmail.com", "saadcenter2000@yahoo.com", "abouali@hotmail.c", "abouali2510@yahoo.com", "bm-soft@scs-net.org", "ab-saleh@hotmail.com", "pat00l@hotmail.com", "protecenviro@aol.com", "kuzwiny@yahoo.com", "asshurrab@yahoo.com", "asker232@yahoo.com", "c-h-a--d-i@hotmail.com", "salman_ghamdi@hotmail.com", "maths81@yahoo.com", "eng_msm10@yahoo.com", "bounjour2020@hotmail.com", "ww4ss@hotmail.com", "sho_moos@yahoo.com", "driss783@caramail.com", "pariss49@hotmail.com", "ali_nasree@yahoo.com", "aaw991@hotmail.com", "adel_team_work@yahoo.com", "abdelhamed_a@hotmail.com", "mahmoudsalim2@hotmail.com", "g7jobs@yahoo.com", "zeogeo@hotmail.com", "koool-l9995@hotmail.com", "the_bee_1984@hotmail.com", "msm_1971@yahoo.com", "el_english_2007@hotmail.c", "janagh@hotmail.com", "ayat91@gmail.com", "haby_1968@yahoo.com", "necc300077@yahoo.com", "samir_smr@hotmail.com", "girls0job@gmail.com", "ouss_offer@hotmail.com", "memasemsema@yahoo.com", "icg_malk@hotmail.com", "mona_6161@hotmail.com", "maya20.06@hotmail.fr", "thamer_37@hotmail.com", "rabie@ghcforex.com", "maw_wnm@yahoo.com", "noor@aljandool.com", "moh@hgicom.com", "ameer_aha@hotmail.com", "esraadodaa@hotmail.com", "adelvet81@yahoo.fr", "fastlink765@yahoo.com", "gadeeb@ghabbour.com", "www.zoubiisam@yahoo.com", "kingtutonline@gmail.com", "abouahmed2007@hotmail.com", "munafarz@yahoo.com", "nabeel_youths@yahoo.com", "sultan.alsaud@hotmail.com", "homealone_q8@hotmail.com", "www.raed_alsager@yahoo.co", "bicocairo@gmail.com", "gasmen_sema@hotmail.com", "mustafa_tasa@hotmail.com", "salah_tby@gawab.com", "sajeda_lelah@hotmail.com", "mazhar6666@hotmail.com", "gewaly_68@yahoo.com", "sun_oflove1@yahoo.com", "mumase@hotmail.com", "mahdey@maktoob.com", "omar1996om@gmail.com", "aboakram_5@hotmail.com", "info@mohtawa.com", "lil2005_1977@hotmail.com", "tepegypt@hotmail.com", "dubaiexpo@hotmail.com", "aaalghamdi@hotmail.com", "njnjnjnj@naseej.com", "lelnas@yahoo.com", "drayademerty@yahoo.com", "thaa20@yahoo.com", "vip919vip@yahoo.com", "sisqo817@hotmail.com", "muham-80@aloola.sy", "www.ragheb_1964@hotmail.c", "deem_5544@hotmail.com", "msoft_easycash@yahoo.com", "m7777m@maktoob.com", "amr_raslan2001@yahoo.com", "almageed478@yahoo.com", "ikram@qiib.com.qa", "haisam-sakr@maktoob.com", "alajlan@emirates.net.ae", "info@greencover.net", "mahmouda99@yahoo.com", "aaalgahmdi@hotmail.com", "sarah_nfrt@yahoo.com", "leader_accountant@yahoo.c", "haniwal2002@yahoo.com", "limetfax@hotmail.com", "yvonne5@quicknet.nl", "aelzohry@yahoo.com", "aymjad@gmail.com", "handsa2007@gmail.com", "rhf55@hotmail.com", "hanonty_800@hotmail.com", "lolobebo2008@yahoo.com", "oman_1969@hotmail.com", "braveprinceknight@yahoo.c", "ess644@hotmail.com", "mansoor3322@hotmail.com", "maw-wnm@yahoo.com", "prince_v7@yahoo.com", "elassuity2007@yahoo.com", "vip-m666@hotmail.com", "emad7272@hotmail.com", "scorbeon2200@yahoo.com", "ahmed__9898@hotmail.com", "md_italie@hotmail.com", "almpad@hotmail.com", "zakia_20_3@hotmail.com", "kelobatra11@yahoo.com", "nana_karem55@yahoo.com", "youngman_m007@hotmail.com", "moyaser85@yahoo.com", "celcott@gmail.com", "orient.hr.co@gmail.com", "info@magaan.com", "xmx@hotmail.com", "roshdy2001@hotmail.com", "rabie_lave@yahoo.com", "goodgirl200@maktoob.com", "mydream4111403@hotmail.co", "freedom2soul@hotmail.com", "ibrahim_radwan7@yahoo.com", "graylyonredeye@yahoo.com", "anosh_blast@yahoo.com", "sameh_morir@yahoo.com", "yafo@maktoob.com", "raghda_salon@hotmail.com", "pino_727@hahoo.com", "alwehedy@alwehedy.com", "al7anona123@hotmail.com", "info@smn-one.net", "tamer_morgan@hotmail.com", "abeer_dream@hotmail.com", "mosul_333@yahoo.com", "moh_farouq@yahoo.com", "s51116@hotmail.com", "marocmaroc@maktoob.com", "mialamir@yahoo.com", "hotlineeln8@yahoo.com", "lovelybonbon16@yahoo.com", "shwsh2005@hotmail.com", "nagyfarag@yahoo.com", "md_eva@hotmail.fr", "falcongroup1996@yahoo.com", "ash020002001@yahoo.com", "hagagkassem@yahoo.com", "zozokhaton@hotmail.com", "marketing@ektnaa.com", "samir_bnz@hotmail.com", "nemomahy@yahoo.com", "oussama_tay83@hotmail.com", "k7lal3ioon@hotmail.com", "german_muslim@yahoo.com", "lidoegy@hotmail.com", "h_hamdan@hotmail.com", "mokkz1998m@yahoo.com", "meneam_79@yahoo.com", "mohamedcma@hotmail.com", "ulfwisse@t-online.de", "cherifamoon@hotmail.com", "kmkm2000_5@hotmail.com", "almawasm@hotmail.com", "hamorkm@hotmail.com", "kidswoodhouse@hotmail.com", "dalia_11283@hotmail.com", "rehabalali@gmail.com", "michou2185@yahoo.com", "salah_tebessa@yahoo.com", "algamel66@yahoo.com", "mahmoud.hafez1978@yahoo.c", "t6wer-serv@hotmail.com", "eng_yosra84@yahoo.com", "ronq-rb@hotmail.com", "rolaa16@yahoo.fr", "al-mutawakel@maktoob.com", "volume-sales@hotmail.com", "eng4electra@yahoo.com", "3ekarat@maktoob.com", "future4cs@yahoo.com", "atef_gh77@hotmail.com", "mohamedmotors@yahoo.com", "transfreightegypt@yahoo.c", "mo.ed@hotmail.c", "wm.wm2003@hotmail.com", "kasoon@hotmail.com", "fesher50@hotmail.com", "m-ismail@link.net", "aymanweb@yahoo.com", "kans8@hotmil.com", "ehab_abdelstar@yahoo.com", "a44a44@hotmail.com", "ahlam-ranin@hotmail.com", "nawraz_b@yahoo.fr", "mohnoor58@yahoo.com", "b.-7@hotmail.com", "zorba2011@yahoo.com", "nagaf_nagaf@yahoo.com", "ecommerce20@gmail.com", "zos1@topnet.tn", "miss_nooora2008@yahoo.com", "hazembahr78@hotmail.com", "markting@ektnaa.com", "info@segaalsoft.com", "mothhelah_1@hotmail.com", "tegari@yahoo.com", "dolphi2007@yahoo.fr", "info@the-mas.com", "egyforexx@yahoo.com", "abd_abd0@hotmail.com", "hussam.s.love@hotmail.com", "kldoun@hotmail.com", "noga3011@hotmail.com", "ehab_ebada@yahoo.com", "jumadarwish@yahoo.com", "asmkrh@yahoo.com", "sosoyasooo@yahoo.com", "tota98_2006@hotmil.lcom", "besher1995@gmail.com", "haidar@fujilift.com", "dodetote@hotmail.com", "alnaokea@yahoo.com", "v012010@gmail.com", "patelle_00@hotmail.fr", "q8doha@yahoo.com", "kal8_88@yahoo.com", "kal8_88@maktoob.com", "khalil.otaibi@hotmail.com", "shiakhi@hotmail.c", "wxswx@hotmail.com", "h_k_shahin@hotmail.com", "ahmedhassanen67@yahoo.com", "rove.a2z@gmail.com", "mamd-fany@hotmail.com", "sahar_elwaf@hotmail.com", "dr_hodhod777@yahoo.com", "emconcontractor@yahoo.com", "clvansa@hotmail.com", "asd2156@hotmail.com", "momani76@hotmail.com", "ayman_zekri@yahoo.com", "tamer_elkafrawy@msn.com", "health_well@yahoo.com", "ismailabdelmalek@yahoo.co", "md500005@hotmail.com", "semba498@yahoo.com", "faresking@gmail.com", "ababdalziz2@hotmail.com", "hmah55@yahoo.com", "fahdzxc@hotmail.com", "mehdipub@voila.fr", "al3ashq6666@hotmail.com", "moataz_higgi@yahoo.com", "mennoha@yahoo.com", "elzajel@hotmail.com", "mg2255mg@hotmail.com", "jabproj@yahoo.com", "bassit_@hotmail.fr", "deal@gulfinternational.sk", "deeem1407@hotmail.com", "ahmd13@hotmail.com", "hanane_95@yahoo.fr", "memouna13@maktoob.com", "maie_mohamad@yahoo.com", "mng81@maktoob.com", "job.baradan@gmail.com", "shiningnight@maktoob.com", "sohaid888@hotmail.com", "tameradel@hotmail.com", "thamr_10@hotmail.com", "mhamdfoda@yahoo.com", "alnbras@maktoob.com", "gwy5000@yahoo.ca", "a_k2222@hotmail.com", "biz.s@hotmail.com", "ali2003rak@yahoo.com", "ashraf4ue@hotmail.com", "w.madh@hotmail.com", "h.a.love.f.e@hotmail.com", "ehab_nour2000@yahoo.com", "ihab2007f@yahoo.com", "del470@yahoo.com", "eng_nidal82@yahoo.co.uk", "sayaf2008@yahoo.com", "jobs@asiatopmed.com", "lahcen_ess@hotmail.com", "mostfa_me@yahoo.com", "tse1393@hotmail.com", "zaidy72@yahoo.com", "han33s@hotmail.com", "karkar182@maktoob.com", "moha_higazy_33@yahoo.com", "karee-3@hotmil.com", "zizohalim70@yahoo.com", "alhob22@hotmail.com", "soufya20@hotmail.fr", "riyadal@hotmail.com", "sa_ma85@hotmail.com", "1384@yahoo.com", "samahdiab2000@hotmail.com", "yamnaamina@hotmail.com", "goubranh@emro.who.int", "suleiman1957@yahoo.com", "asdff_asdff42@yahoo.com", "turku2440@hotmail.com", "foudil79@yahoo.fr", "maroc88@maktoob.com", "yasser.salama@gpsco.net", "m.hola@hotmail.com", "adanegypt@gmail.com", "mohammed_hakeim@yahoo.com", "mamado@mamadoinc.com", "aymanelachgar@yahoo.fr", "cute_boy622@hotmail.com", "italian83@hotmail.com", "mv-@msn.com", "mr_hima@msn.com", "freedom111_@hotmail.com", "anajeddah@yahoo.com", "wow131@hotmail.com", "amer4adv@yahoo.com", "menaa@maktoob.com", "saeeelfars_72@yahoo.com", "koubatec@hotmail.com", "shaweesh_j@yahoo.com", "al_warrak@hotmail.com", "jamal-salam@hotmail.com", "alhmmadi9@gmail.com", "yosef2010@hotmail.com", "mr.milionare@hotmail.com", "samysadeek@yahoo.com", "momzz@maktoob.com", "mm_xp_xp@hotmail.com", "mhr_632@hotmail.com", "momu11@hotmail.com", "ibrahimsaloul@hotmail.com", "ahmed_ragab_1973@yahoo.co", "malk_1177@hotmail.com", "jedawy68@hotmail.com", "nour_elkhaleeg@hotmail.co", "mostafa_programmer@msn.co", "abo.shhad@gmail.com", "darweesh_tamer@yahoo.com", "prog_sherief@yahoo.com", "bishryb@yahoo.com", "hadi200200@hotmail.com", "sharkakey@hotmail.com", "zayan.bahy@yahoo.com", "samora605@yahoo.com", "nrmnyehia@yahoo.com", "taroooq55@hotmail.com", "spiky_xli@yahoo.com", "magic_bassam@yahoo.com", "laa3ieeb_taawlaa@yahoo.co", "shsa61079@yahoo.com", "al_musafir55@yahoo.com", "h_3amal@hotmail.com", "theking_samireg@yahoo.com", "m7pob_vip@yahoo.com", "yehia_elforqan@yahoo.com", "abdo_hema70@yahoo.com", "aoa123@hotmail.com", "noga4000@hotmail.com", "hassan_hayyan@yahoo.com", "drmabdalla@yahoo.com", "boos_881996@yahoo.com", "hisham@alfalahye.net", "lion20044@hotmail.com", "almhammad@naseej.com", "lfe52@yahoo.com", "red_boy11@hotmail.com", "ch_dahli@yahoo.fr", "hamdyntu@yahoo.com", "shmehdi57@yahoo.com", "raymond_salama@yahoo.com", "busbaia@hotmail.com", "saboco777@yahoo.com", "a_s_mohammad@yahoo.com", "info@basharco.com", "www.koky_202010@yahoo.com", "koky_202010@yahoo.com", "morly64@hotmail.com", "_1905@hotmail.com", "w_reko@yahoo.com", "nmm2005_50@yahoo.com", "plplpl_555@hotmail.com", "kotoz_kotoz@yahoo.com", "b2007ly@hotmail.com", "dandon-m@hotmail.com", "osamamoota@yahoo.com", "zain@retaj-tk.com", "rosemo0on@yahoo.com", "geturpassport@yahoo.com", "antakh10@hotmail.com", "iuiuiuiuiu@gawab.com", "empeloy@hotmail.com", "qa6996@hotmail.com", "project_books@yahoo.com", "multirolla@yahoo.com", "ezz220@mktoob.com", "nancy555_nor555@yahoo.com", "buildupurself@yahoo.com", "pack_885@hotmail.com", "hanane_nona_@hotmail.com", "arabeam_4@yahoo.com", "bos_egypt1@yahoo.com", "hr_eliteresorts@yahoo.com", "ilam-amour@hotmail.fr", "cadsoul22@yahoo.com", "kkk8@hotmail.com", "id0101_a@yahoo.com", "dina_d1981@yahoo.com", "sm55sm@gmail.com", "walled_hassan2001@yahoo.c", "gt0101000@yahoo.com", "mohamad_k1@hotmail.com", "elforsa.eg@gmail.com", "shj1900@hotmail.com", "cry2u@hotmail.com", "vip_vip_sa@hotmail.com", "solexport@hotmail.it", "kadid@hotmail.com", "magdy_ahamed@yahoo.com", "kaity032@yahoo.com", "amst123@maktoob.com", "zerconn@hotmail.com", "mt_zaydan@yahoo.com", "r.v.i.p@hotmail.com", "a-hassan@maktoob.com", "dr_sayed11@yahoo.com", "hathatt@hotmail.com", "b77wcom@hotmail.com", "zooooora_2000@hotmail.com", "moonlight1@w.cn", "athoobq8@yahoo.com", "hhuu236@hotmail.com", "rissoulysyslog@yahoo.fr", "info@ahssc.com", "safaflower2006@hotmail.co", "h2_group@hotmail.com", "turki_alotaibi@hotmail.co", "misr_el_gawda@yahoo.com", "nohamohammed@netscape.net", "emad_eldeen11@yahoo.com", "mail@jebchit.com", "alrebae55@hotmail.com", "me_placement@yahoo.com", "imuhaithief@hotmail.com", "ok2000620006@yahoo.com", "ok200062000@yahoo.com", "fahad9x@hotmail.com", "perfect_job1@yahoo.fr", "naaje@maktoob.com", "abdomrd@hotmail.com", "lama_ahmed99@yahoo.com", "taachirat@hotmail.com", "fahedkf4@hotmail.com", "dala3_emarati@hotmail.com", "ousamasaleh@mail.sy", "dhb1976@hotmail.com", "arc4eng@hotmail.com", "m19m3@hotmail.com", "hamdy_atya_1@hotmail.com", "good1235789@hotmail.com", "ilovesamaa@yahoo.con", "josef-an@hotmail.com", "nanareem68@hotmail.com", "zxcvb2007@maktoob.com", "josef-an@hotmail.com01", "alwalhan2424@hotmail.com", "modern.trends@yahoo.com", "hexaco_net@hotmail.com", "e7lao@hotmail.com", "tjrooonh@hotmail.com", "dd8_@hotmail.com", "jeddah@zamilco.com", "magedmradwan@gmail.com", "marm-22@hotmail.com", "hana.arab@gmail.com", "www.mg_sanam@yahoo.com", "drwesh_low@yahoo.com", "lion198xx@hotmail.com", "d_k_mm1@hotmail.com", "gigi_mot@yahoo.com", "lokammaloka@yahoo.com", "arg196587@hotmail.com", "hossam_na2006@yahoo.com", "mohamedhamdi73@hotmail.co", "abozekry@gmail.com", "transaction@gawab.com", "blazikim@yahoo.fr", "scorpion_a188@yahoo.com", "salah4722@yahoo.com", "r.ryan@hotmail.fr", "abo_yassine@hotmail.com", "rola1212@hotmail.com", "munassiq@hotmail.com", "ld_mon1@yahoo.com", "miaes_el_gawda@yahoo.com", "haroon123@nolmail.net", "miaer_el_gawda@yahoo.com", "hoda4909@hotmail.com", "aramco_26@hotmail.com", "ayfaifi@hotmail.com", "ehabali55@hotmail.com", "ah_zanaty@hotmail.com", "ugd_64@hotmail.com", "hanin_is_me@hotmail.com", "medo_elhaw@hotmail.com", "naikmoon@hotmail.com", "rose-700@hotmail.com", "hanismg@yahoo.com", "ima123654@hotmail.com", "maser_el_gawda@yahoo.com", "zeena_uae@hotmail.com", "re_m_ix@hotmail.com", "hala_elngar@yahoo.com", "mmss95@hotmail.com", "thehappybird@yahoo.com", "design_asr@yaho.com", "mralnafe@hotmail.com", "eng.sultann@hotmail.com", "haythambadr3@yahoo.com", "millioner1minute@yahoo.fr", "ahmed_tohame1@yahoo.com", "warif@mail2world.com", "machmoud@narod.ru", "cavesols@yahoo.fr", "elmahalawei@yahoo.com", "wagdy3010@hotmail.com", "ame_10002@hotmail.com", "massira840@hotmail.com", "egilany@hotmail.com", "ismailhikma@hotmail.com", "mntromania@yahoo.com", "dr_hodhod77@hotmail.com", "msh_39mi@hotmail.com", "al22la@hotmail.com", "az_123456789@yahoo.com", "sys_20055@hotmail.com", "hozain_hozain@hotmail.com", "bouchamlanader@yahoo.fr", "imrannet73@hotmail.com", "purplerose9999@hotmail.co", "eissa_sheple@hotmail.com", "zag_micro2002@yahoo.com", "al-marwa@al-marwa.net", "hananelsayed2002@yahoo.co", "info@eiadeyeclinic.com", "galleryislam@yahoo.com", "mohmed_kimo@yahoo.com", "patwoman@maktoob.com", "abaza3000@hotmail.com", "sowilem2000@hotmail.com", "lassfar_85@hotmail.com", "freedivingbird@hotmail.co", "elmansi@hotmail.com", "qatoosa@hotmail.com", "azzem.ben@hotmail.com", "ararat2001sa@yahoo.com", "themoon1sister@yahoo.com", "bet_al3mor@hotmail.com", "husseinsobah@yahoo.com", "narjes-18@hotmail.com", "alborak_shahawy@hotmail.c", "mohadsh2001@yahoo.com", "prof_market@hotmail.com", "moamer66@hotmail.com", "cute_beeboo@hotmail.com", "fares_merwa@hotmail.com", "koka99999@hotmail.com", "monaezz2007@yahoo.com", "l0xl0@hotmail.com", "wizard_egypt@hotmail.com", "greetlife2007@yahoo.com", "faseehgamal@yahoo.com", "alagaype_ms@yahoo.com", "aminakeswa@gmail.com", "diaa_1986_eg@yahoo.com", "amanmar72@yahoo.com", "malakmatiny@hotmail.com", "hanyegypt@hotmail.com", "rockypotter@hotmail.com", "dowwar@gmail.com", "emadbosh@yahoo.com", "ghaydaa_23@hotmail.com", "roubyman1@hotmail.com", "ibrahem_sand@yahoo.com", "i.jeddah@hotmail.com", "gawab32@gawab.com", "ashrafwsaleh@hotmail.com", "eng_mhmdhamdy@yahoo.com", "ahmedzeko9002@yahoo.com", "truks2sell@gmail.com", "faljudi@hotmail.com", "bader_asd@hotmail.com", "w99ww99w@hotmail.com", "max_sun123@hotmail.com", "fahd614@hotmail.com", "amina_1982_e@hotmail.com", "ayat91@hotmail.com", "end1@hotmail.com", "nasmoq65@yahoo.com", "eldoradojose@yahoo.fr", "saleh5620@hotmail.com", "info@elrouda.com", "samadihamid@hotmail.com", "abofaisal_47@hotmail.com", "amina_ayman2007@hotmail.c", "aminelook@hotmail.com", "speedabode@hotmail.com", "aboudy_2004@hotmail.com", "dallysudan2006@hotmail.co", "mayadin2@hotmail.com", "mukhtar25@hotmail.com", "the_zax@hotmail.com", "ya-3athabe@hotmail.com", "zainab_ahmed1985@yahoo.co", "nehadsaleim@gmail.com", "zeema20042000@yahoo.com", "darkrever@gmail.com", "smart_group_co@yahoo.com", "jobs_home111@yahoo.com", "mafnood999@hotmail.com", "mo_sophy1@hotmail.com", "lovely00heart@hotmail.com", "gmoemen@hotmail.com", "elsakk@hotmail.com", "meero4ever@hotmail.com", "vainsaid_1_@hotmail.com", "duhakhali@yahoo.com", "lexus-uae@hotmail.com", "hse_lama@yahoo.co", "maher2234@yahoo.com", "nile_info@yahoo.co", "workathome.2006@yahoo.fr", "bower2020@yahoo.com", "omreissa@yahoo.com", "reem273@hotmail.com", "workathome@yahoo.fr", "sharar2007@maktoob.com", "engineerarts@hotmail.com", "uae_heart3@hotmail.com", "safeer_jop2000@yahoo.com", "fmsmt01@hotmail.com", "ali41163@yahoo.com", "shehata011@gmail.com", "leenachina@hotmail.com", "ksa@ksa.saudi", "taher_taher122@yahoo.com", "kalid1428@hotmail.com", "shahin@srpc.com", "kaaaag@yahoo.com", "mr-mesh3l@hotmail.com", "asiah.eng@gmail.com", "handtonhand@yahoo.com", "ababid@gawab.com", "uae_3qar@hotmail.com", "amussllam@yahoo.com", "magd22222@hotmail.com", "ta.lcse@msn.com", "hanane_sari@yahoo.fr", "nm_2001@hotmail.com", "almasry_yy@yahoo.com", "homamahmad@hotmail.com", "vfduhgshgl@yahoo.com", "abeero55@yahoo.com", "dct21uae@hotmail.com", "hashbool@hotmail.com", "ahmdaaa5006@hotmail.com", "ruslan-81@hotmail.com", "najdmedic@hotmail.com", "ayman_magic2002@yahoo.com", "bnadar.s@gmail.com", "pole_ahmed@hotmail.com", "dally_mh@yahoo.com", "r_ad_wa@hotmail.com", "monaliza_salem@yahoo.com", "sadki03@hotmail.com", "mohammed_hablas@hotmail.c", "smh_sameh2002@hotmail.com", "mo0o0o0o0o0l@hotmail.com", "i7sas@i7sas.com", "1975osa@maktoob.com", "ksh383833@yahoo.com", "monasekbared@yahoo.com", "nbn45@yahoo.com", "fmsmt01@hotmil.com", "terraz_leila@yahoo.fr", "abu_danyale@hotmail.com", "khaled2356@yahoo.com", "rmsads@hotmail.com", "lacoste_boss@hotmail.fr", "khaled4464@hotmail.com", "ramyfarag_m@yahoo.com", "smile_sss@hotmail.com", "iktoor_2@hotmail.com", "matrix_mine@hotmail.com", "al-tigger@hotmail.com", "ahmmad1972@hotmail.com", "saker_osama@yahoo.com", "a7-l@hotmail.com", "ehabghad2020@yahoo.com", "wigmib@yahoo.com", "pajo666@yahoo.com", "m.mechmach@gmail.com", "yous26222@yahoo.com", "rahma1970@hotmail.fr", "bajawas_2005@hotmail.com", "miky_2192@yahoo.com", "magic_man709@yahoo.com", "ahmedheg@yahoo.com", "ben_bel2@yahoo.fr", "m22588@hotmail.com", "mo7taram_1984@hotmail.com", "mail2292@gmail.com", "bibosbibos@yahoo.com", "workhome72@gmail.com", "h-nine@hotmail.com", "moemen25112000@gawab.com", "gdgd_81@yahoo.com", "honey_sheko@yahoo.com", "buchra5@hotmail.com", "badea_hassan@yahoo.com", "renaz.1988@yahoo.com", "munassik@yahoo.com", "m_habib66@hotmail.com", "on71@hotmail.com", "bilel-abou-zeyd@hotmail.c", "alsharabenet5@maktoob.com", "hamdi_m1984@yahoo.com", "rhimo@banat21.com", "souad@banat21.com", "hssngd@gmail.com", "asmaa_love_82@yahoo.com", "fer-forge10@hotmail.com", "a_nn10_a@hotmail.com", "ayman_dahy1972@yahoo.com", "wrashad@elahlyassets.com", "globe-on@hotmail.com", "manal803@yahoo.com", "welcom-10@hotmail.com", "chouchouhanime@hotmail.co", "jamalbof@gmail.com", "baddore@hotmail.com", "archbamr@yahoo.com", "anwer_trad_72@yahoo.com", "mechanical_ps@yahoo.com", "d_almllahi@yahoo.com", "asmaksy@yahoo.com", "saad-nada@hotmail.com", "noors_1970@hotmail.com", "zii0@hotmail.com", "warda_051@hotmail.com", "rmomani@dinogroup.com", "optiontocanada@yahoo.com", "top_eng_adel@hotmail.com", "amr_alshsk@yahoo.com", "asoreemco@hotmail.com", "mrbander@hotmail.com", "s.kanbar@el-seif.com.sa", "i-bustami@hotmail.com", "wajde66@hotmail.com", "fawzy990@hotmail.com", "drunker_eblies@yahoo.com", "asheq_20@hotmail.com", "ayh_ayh10@yahoo.com", "n_nonoli@hotmail.com", "hatemminia2006@yahoo.com", "nisr_tn@hotmail.com", "nicetar4@maktoob.com", "nicestar4@maktoob.com", "garib12345@hotmail.com", "ugcc1421@marsool.com", "green_h_m@msn.com", "ehk32001@yahoo.com", "albrg8888@hotmail.com", "marmar_81_7@hotmail.com", "karizma_p3@hotmail.com", "dodyelbaroudy@yahoo.com", "medical_office1@yahoo.com", "aasb80@hotmail.com", "w261075@yahoo.com", "cairo_mall@yahoo.com", "omaymaelias@hotmail.com", "a_ali_saleh@hotmail.com", "bmw1998@islamway.net", "selloufhassan@hotmail.fr", "adilovich_ma@hotmail.com", "love1_6666@hotmail.com", "abdelhamid11000@yahoo.fr", "stronger77140@yahoo.com", "yasseryaya152@hotmail.com", "mohammad7001@yahoo.com", "jojosho2006@hotmail.com", "akramo2006@maktoob.com", "ukraineyalta@maktoob.com", "rshd55@hotmail.com", "ramy_love203@yahoo.com", "redha_haddad@yahoo.fr", "salwa1979_love@yahoo.fr", "lammo001@hotmail.com", "waleed990@hotmail.com", "nokhetha@maktoob.com", "maharefaat27@yahoo.com", "zeinziko@yahoo.com", "koky_wally@yahoo.com", "fafayka55@hotmail.com", "roseydesigner@yahoo.com", "lesziza@yahoo.fr", "el_hindo@hotmail.com", "cascojobs@gmail.com", "alamam25@hotmail.com", "malkolm_1992@hotmail.com", "d6d64@hotmail.com", "emannawa@yahoo.com", "memo2006.a@hotmail.com", "sheree15@hotmail.com", "foode_123@hotmail.com", "sherifstc@yahoo.com", "eclaire-02@hotmail.com", "tassem@gawab.com", "wwwmm_200@hotmail.com", "gani324@yahoo.com", "waelaaa2004@yahoo.com", "alz3em9@hotmail.com", "fnm175@hotmail.com", "s-afwah@hotmail.com", "alia_ahlan@yahoo.com", "danohelen@yahoo.fr", "mm2015mm@hotmail.com", "maatouq@hotmail.com", "arab2web@hotmail.com", "motsbb@yahoo.com", "info@istrafx.com", "yasserf16@hotmail.com", "kingsahm@yahoo.com", "mido_mando2001@yahoo.com", "pinklow988@hotmail.com", "zahama@hotmail.com", "alflila@gawab.com", "hassouma16@yahoo.fr", "emh_nor@hotmail.com", "al3uoon669@hotmail.com", "ss_nn_88@hotmail.com", "loura_jesus@hotmail.com", "mos20032001@yahoo.com", "belcasem@hotmail.com", "halokaily@yahoo.com", "almhndes2005@hotmail.com", "hebaaldeen@maktoob.com", "waj-1@hotmail.com", "alarabiah@hotmail.com", "alhaitham22@hotmail.com", "jnooon3003@yahoo.com", "b.s.o2010@hotmail.com", "tamoilalbizog@yahoo.com", "alaman25@hotmail.com", "semsem4m2002@hotmail.com", "al.johinh@gmail.com", "nasserexpress@gmail.com", "mohamedalh@maktoob.com", "info@sosweet.com.sa", "vl4evr_6alalza@hotmail.co", "m2hizam@hotmail.com", "samraaelneel_12@yahoo.com", "callyard@yahoo.com", "vip.a1@hotmail.com", "amerfahmeh@yahoo.com", "lubjana1977@yahoo.fr", "yafgate@yahoo.com", "assa1423@hotmail.com", "jobs@sahara.com", "market4all@gmail.com", "missfashion2007@yahoo.com", "alsharqy123@yahoo.com", "barakat.waziery@yahoo.com", "mmrrssh@hotmail.com", "loly_hamad@hotmail.com", "hglhsdmsvd@hotmail.com", "mr.mohamed48@yahoo.com", "teleb_adel@hotmail.com", "nmin4@hotmail.com", "thedarkerwww@yahoo.com", "mnmn_mnmn157@yahoo.com", "hebasalah2002@hotmail.com", "aa.co@hotmail.com", "ahmed_2a_2010@yahoo.com", "ms_yt@hotmail.com", "sasi326@hotmail.com", "roseq8ty@hotmail.com", "m.gharib2006@hotmail.com", "me888net@yahoo.com", "heert258@hotmail.com", "mtts00@hotmail.com", "sharochico@hotmail.com", "bahida@maroc.com", "saucy2010@yahoo.com", "mohamd_336@hotmail.com", "zarita@maktoob.com", "bandar_aldawe@hotmail.com", "iaq8888@hotmail.com", "shahawy1953@hotmail.com", "magd_20002000@hotmail.com", "amd_alain@hotmail.com", "lacoste-nokia@hotmail.com", "zayed_trading@yahoo.com", "aboahmed_sh2000@yahoo.com", "elatra_2006@hotmail.com", "bznz2@hotmail.com", "zakaria-118@hotmail.com", "mero226@masrawy.com", "man3oom@hotmail.com", "forex2007@gmail.com", "mhussen2000@yahoo.com", "s3_55@hotmail.com", "n_quffa@hotmail.com", "hhns@hotmail.com", "aliafkar123@hotmail.com", "ali1234_1@hotmail.com", "a_baj@hotmail.com", "samir_dongola@yahoo.com", "samer_tito210@hotmail.com", "sendbad_20_05@yahoo.com", "abujoher69@yahoo.com", "dr.2008as@yahoo.com", "tetrite2010@yahoo.fr", "esamgoodboy@yahoo.com", "al_7urr1974@hotmail.com", "lolo9911@hotmail.com", "yskh@hotmail.com", "emadkifah-92@hotmail.com", "heshameraqy@yahoo.com", "nasser737@hotmail.com", "naragorup@hotmail.com", "milanyx@hotmail.com", "mantaegypt@yahoo.com", "astra632003@hotmail.com", "fatimazohrafes@yahoo.fr", "sager_habara@hotmail.com", "nirmin_1_2_3@hotmail.com", "ambagader@hotmail.com", "y_alb1969@yahoo.com", "rosemo0on@yaoo.com", "noras_get@hotmail.com", "meto1982@hotmail.com", "saf8000@hotmail.com", "ahm2020_5@hotmail.com", "elka49@hotmail.fr", "yaser_farouq2000@yahoo.co", "sabih500@yahoo.com", "mustafa4356@hotmail.com", "gmmseas@yahoo.com", "mouna1_amour1@hotmail.com", "moon990099@yahoo.com", "fati_moroco@hotmail.com", "ganbah@hotmail.com", "abohirr@37.com", "almasia642@hotmail.com", "dainty_dainty@hotmail.com", "khaliloozx@maktoob.com", "fad_kha@yahoo.com", "zeed0@hotmail.com", "muaseem@hotmail.com", "n_s999@hotmail.com", "jarrafati@yahoo.fr", "basma3-666@hotmail.com", "shahin_abdo2000@yahoo.com", "angali80@hotmail.com", "hindika@hotmail.com", "gnaty_948@hotmail.com", "egyrec@hotmail.com", "huda_aly_love@yahoo.com", "sam_msd@yahoo.com", "e7sass-uae@hotmail.com", "m_g44@hotmail.com", "hoba_happy2000@yahoo.com", "sara2691984@yahoo.com", "ahmedmshaal006@yahoo.com", "msh_nsh1@hotmail.com", "job@wess.com.sa", "nour43@gawab.com", "rashed_k_a@hotmail.com", "taoufik_hamouda@hotmail.c", "yasser_16172@yahoo.com", "ismcom1@hotmail.com", "aboody_2_00_4@hotmail.com", "baddan_v@yahoo.com", "support@202eg.com", "amjadfaisal@hotmaill.com", "herrar555@hotmail.com", "jkawtar2@hotmail.com", "haem_60@yahoo.com", "alkeshta@hotmail.com", "ali_md_2011@yahoo.com", "wwtc8@yahoo.com", "okingo2003@yahoo.com", "alserehi@gmail.com", "jall5@caramail.com", "aldhalan@yahoo.com", "aryyyam111@hotmail.com", "sh_bs2003@yahoo.com", "in_usama@yahoo.com", "notfullstop@hotmail.com", "weakful@yahoo.com", "mido6_@hotmail.com",
            "m.abuelezz97@gmail.com",
            'sherifabouelezz@gmail.com',

        ];



        foreach ($emails as $email) {
            Mail::to($email)->queue(new DashboardMail(
                ('لو انت صاحب مهنة او مقدم خدمات او صاحب مشروع موقع ' . config('app.name') . ' هايوصلك بالعملاء القريبين منك بكل سهولة  وتقدر تتابع حجوزاتك واحصائياتك مجانا.
                بمناسبة افتتاح الموقع
                التسجيل مجاني لاول 1000 مشترك   ... سارع الان 👍'),
                null
            ));
        }

        //ok
    }
}
