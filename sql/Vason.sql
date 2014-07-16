-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Jul 16, 2014 at 11:23 AM
-- Server version: 5.5.34
-- PHP Version: 5.5.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Vason`
--

-- --------------------------------------------------------

--
-- Table structure for table `Genre`
--

CREATE TABLE `Genre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `Genre`
--

INSERT INTO `Genre` (`id`, `name`) VALUES
(1, 'Drama'),
(2, 'Musik'),
(3, 'Romantik'),
(4, 'Äventyr'),
(5, 'Familj'),
(6, 'Sci-Fi'),
(7, 'Thriller'),
(8, 'Barn'),
(9, 'Biografi'),
(10, 'Action'),
(11, 'Skräck'),
(12, 'Komedi'),
(13, 'Fantasy'),
(14, 'Kriminal'),
(15, 'Mysterium');

-- --------------------------------------------------------

--
-- Table structure for table `Movie`
--

CREATE TABLE `Movie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `director` varchar(100) DEFAULT NULL,
  `length` int(11) DEFAULT NULL,
  `year` int(11) NOT NULL DEFAULT '1900',
  `plot` text,
  `image` varchar(100) DEFAULT NULL,
  `subtext` char(3) DEFAULT NULL,
  `speech` char(3) DEFAULT NULL,
  `quality` char(3) DEFAULT NULL,
  `format` char(3) DEFAULT NULL,
  `imdb` varchar(100) DEFAULT NULL,
  `trailer` varchar(100) DEFAULT NULL,
  `price` int(11) DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `Movie`
--

INSERT INTO `Movie` (`id`, `title`, `director`, `length`, `year`, `plot`, `image`, `subtext`, `speech`, `quality`, `format`, `imdb`, `trailer`, `price`) VALUES
(1, 'The Grinch', 'Dr. Seuss', 104, 2000, 'En fantasifylld komedi med Jim Carrey som den julhatande Grinchen. Filmen bygger på berättelsen "How the Grinch Stole Christmas" från 1957, skriven av den Pulitzer-prisbelönade barnboksförfattaren Theodor S. Geisel som under pseudonymen Dr. Seuss blev känd för sina underfundiga historier. Handlingen utspelas inuti en snöflinga och handlar om Grinchen, en grön, elak och lättirriterad varelse som bor för sig själv. Han är på sitt absolut sämsta humör vid den tid på året då man firar jul i den närbelägna staden Whoville.', 'img/movie/grinchen.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0170016/', 'http://www.youtube.com/watch?v=Pl12cnQxAaU', 30),
(2, 'En oväntad vänskap', 'Olivier Nakache & Eric Toledano', 112, 2011, 'Driss, en ung kille från förorten som precis kommit ut från fängelset, anställs genom en händelse som personlig assistent till den oförskämt rike, men också mycket ensamme aristokraten Phillip som blivit förlamad efter en drakflygningsolycka. Driss är till en början väldigt tveksam till jobbet och Phillips vänner har starka invändningar mot hans val av assistent. Men de två har mycket att lära av varandra. Driss otroliga energi och livsglädje smittar snart av sig på Phillip och Phillip lär Driss en hel del om vett och etikett. Tillsammans upptäcker de nya saker i livet och en oväntad och stark vänskap växer fram mellan två individer som på ytan inte verkar ha någonting gemensamt.', 'img/movie/intouchables.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1675434/?ref_=nv_sr_2', 'http://www.youtube.com/watch?v=dvdJ--DV0Uo', 30),
(3, 'Harry Potter och dödsrelikerna - Del 2', 'David Yates', 144, 2011, 'Allt har lett fram till detta, den ödesmättade uppgörelsen mellan de goda och onda krafterna i magins värld. Ondskan finns överallt och ingen går längre säker men det kan bli Harry Potter som måste göra den största uppoffringen när han en sista gång ställs mot Lord Voldemort. Slutet är här.', 'img/movie/harry-potter.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1201607/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=I_kDb-pRCds', 40),
(4, 'Thor', 'Kenneth Branagh, Joss Whedon', 115, 2011, 'Guden Thor är en kaxig och arrogant krigare som tvingas leva på jorden bland människor som straff för sina gärningar. Den handikappade medicinstudenten Dr. Donald Blake upptäcker plötsligt sitt hittills okända alter ego, som Donald får Thor lära sig vad som krävs av en riktig hjälte.', 'img/movie/thor.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0800369/?ref_=nv_sr_3', 'http://www.youtube.com/watch?v=JOddp-nlNvQ', 40),
(5, 'Lejonkungen', 'Roger Allers', 85, 1994, 'Ingenting kan som Disneys filmer locka en stor publik av gamla och unga. Denna moderna klassiker har setts av närmare 2 miljoner svenskar! Vi bjuds på riktig filmfest för både öga, öra och hjärta i den spännande historien om Simba, som föds för att bli lejonens konung.', 'img/movie/lejonkungen.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0110357/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=GiXoeAs7S54', 20),
(6, 'Stolthet och fördom', 'Joe Wright', 125, 2005, 'Jane Austens roman har åter lockat till filmatisering. Det är den första långfilmsversionen som görs av romanen på över 65 år och är inspelad på plats i England. I centrum står familjen Bennets fem döttrar Elizabeth, Jane, Lydia, Mary, och Kitty. En dag flyttar den rike ungkarlen Mr Bingley till trakten. Han faller snart för familjen Bennets äldsta dotter, Jane, och Mrs Bennett tror att hon säkrat framtiden för en av sina döttrar. Men i Mr Bingleys sällskap följer också en krets av välbärgade människor ur Londons societet. Bland dem Bigleys gode vän, den snygge, men snobbige Mr. Darcy. ', 'img/movie/stolthet-fordom.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0414387/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=fJA27Jujzq4', 20),
(7, 'The Holiday', 'Nancy Meyers', 131, 2006, 'En ung amerikanska och en ung engelska bestämmer sig, efter att ha blivit brända av relationer, att byta liv tillfälligt. Det blir en omställning som ingen av dem riktigt kunnat förstå innan. Men framför allt får de båda möjligheten att träffa betydligt trevligare och charmigare män i sina nya respektive länder.', 'img/movie/the-holiday.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0457939/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=G0p8Su3bdHc', 40),
(8, 'The Notebook', 'Nick Cassavetes', 155, 2004, 'Berättelsen om de unga älskande Noah Calhoun och Allie Hamilton. Tillsammans får de uppleva en passionerad sommar innan de skiljs åt på grund av klasskillnad och Andra världskriget. Efter år på skilda håll återförenas de oväntat. Historien om parets starka kärlek och om de hinder som står i vägen för den berättas decennier senare för en kvinna på ett sjukhem, en kvinna som tas om hand av en man som regelbundet kommer på besök och under dessa visiter läser högt för kvinnan ur en mystisk dagbok.', 'img/movie/notebook.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0332280/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=S3G3fILPQAU', 40),
(9, 'Pirates of the Caribbean - Svarta pärlans förbannelse', 'Gore Verbinski', 143, 2003, 'För den bufflige men ändå charmige kaptenen Jack Sparrow är Karibiens kristallklara vatten som en enda stor lekplats full av äventyr och mysterier. Jacks idylliska liv kapsejsar den dag då den girige kapten Barbossa stjäl hans ögonsten, skeppet The Black Pearl. Barbossa attackerar sedan staden Port Royal och kidnappar guvernörens vackra dotter Elizabeth Swann. Elizabeths barndomsvän Will Turner beslutar sig för att tillsammans med Jack göra ett vågat försök att rädda henne och samtidigt återta The Black Pearl. Vad Will inte känner till är att en förbannelse vilar över Barbossa och hans besättning, en förbannelse som gör piraterna till världens mest fruktade och omöjliga att besegra. En förbannelse som endast kan bli upphävd om den fördömda skatt de rövat återlämnas i sin helhet.', 'img/movie/pirates.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0325980/?ref_=nv_sr_2', 'http://www.youtube.com/watch?v=ZFCno8e-KuI', 30),
(10, 'Coco - Livet före Chanel', 'Anne Fontaine', 110, 2009, 'Bygger på Lirrégulière, biografin av Edmonde Charles-Roux, och berättar om modedesignerns tidiga liv. Porträttet av Coco Chanel visar en kvinna som kommer från ganska knappa omständigheter, som är självlärd och har en unik och exceptionell personlighet. En kvinna som kommit att bli en symbol för framgång och frihet, en kvinna som skapade den moderna kvinnan efter att först själv ha visat vägen. ', 'img/movie/coco.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1035736/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=isEnyrd2Moc', 30),
(11, 'Så som i himmelen', 'Kay Pollak', 127, 2004, 'En internationellt framgångsrik dirigent som drastiskt avbryter sin karriär och ensam drar sig tillbaka till sin barndomsby i Norrland. Det dröjer inte länge förrän man ber honom komma och lyssna på den lilla spillran till kyrkokör som varje torsdag övar i församlingshemmet. Bara komma och kanske ge några goda råd. Han har svårt att säga nej och från det ögonblicket blir inget sig likt i byn. Kören utvecklas och växer. Han får vänner och fiender. Och han möter kärleken. Regissören Kay Pollaks första film på 18 år.', 'img/movie/himmelen.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0382330/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=GtFosApP6bg', 20),
(12, 'Björnbröder', 'Aaron Blaise, Robert Walker', 85, 2003, 'Sitka, Denahi och Kenai är tre bröder som lever i Amerikas vildmarker efter istiden. En dag råkar de i bråk med en björn och Sitka dör. Kenai (yngsta brodern), bestämmer sig för att dräpa björnen, och lyckas med detta. Men de stora andarna straffar honom genom att förvandla honom till en björn. För att bli människa igen, så måste han ta sig till det berg där norrskenet nuddar jorden. På vägen möter han björnungen Koda som vet var berget ligger och leder honom dit. På vägen råkar de ut för allt möjligt samtidigt som de jagas av Kenais andra bror, Denahi.', 'img/movie/bjornbroder.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0328880/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=B80VKbxZs6E', 20),
(13, 'Nyckeln till frihet', 'Frank Darabont', 142, 1994, 'Andy Dufresne (Tim Robbins), är en tystlåten ambitiös man långt kommen i en lysande karriär. Dessvärre är hans förhållande med frun långt i från lyckligt – hon vill skilja sig samt har inlett ett förhållande med en annan. När frun och hennes älskare brutalt skjuts ihjäl åtalas Andy och fälls för morden. Straffet blir två livstider på Shawshank, ett av de värsta fängelserna i USA. I fängelset möts han av den hårda fängelsechefen, Mr Hadley, som styr fängelset med järnhand och mycket övervåld och som i egenskap av sin position misshandlar det mesta som kommer i hans väg. Efter ett tag får Andy reda på att en nyanländ fånge kan hjälpa honom att få målet omprövat.', 'img/movie/nyckelntillfrihet.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0111161/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=5Cb3ik6zP2I', 30),
(14, 'The Shining', 'Stanley Kubrick', 119, 1980, 'Författaren Jack Torrance söker jobb som vintervaktmästare på ett isolerat hotell i Coloradobergen. Under anställningsintervjun får han reda på att den förre vaktmästaren blivit tokig av ensamheten och isoleringen och dödat sin fru och sina två barn. Jack avskräcks inte, utan flyttar till hotellet med sin fru och sin son Danny, som har en förmåga, "The Shining", att se syner och händelser från det förflutna. Hotellets kock Hallorann har samma förmåga och varnar Danny för rum 237 på hotellet… Filmen baseras på en Stephen King-roman.', 'img/movie/theshining.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0081505/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=5Cb3ik6zP2I', 20),
(15, 'Dumma mej 2', 'Pierre Coffin, Chris Renaud', 98, 2013, 'Gru fortsätter sin kamp som förälder till de tre syskonen Margo, Agnes och Edith. Men skurkarna börjar hopa sig och ser Gru som ett hot för deras onda världsbild... ', 'img/movie/dummamej2.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1690953/?ref_=nv_sr_2', 'http://www.youtube.com/watch?v=9cBQ6qdAyW4', 40),
(16, 'Fredagen den 13:e', 'Sean S. Cunningham', 91, 1980, 'Camp Crystal Lake har ett dystert förflutet. En pojke vid namn Jason Vorhees drunknade där eftersom ledarna hade sex med varandra. Året därpå utfördes två bestialiska mord, vilket ledde till att lägret stängdes.Många år har gått, och Camp Crystal Lake öppnas igen. Ovetandes om vad som gömmer sig i skogen anländer lägerledarna för att ha kul. Tror de. Men de inser snart att det inte står rätt till. En efter en försvinner de och paniken kring Crystal Lake tätnar.', 'img/movie/fredagenden13e.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0758746/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=gjiqwTv9yeI', 20),
(17, 'The Big Wedding', 'Justin Zackham', 89, 2013, 'En dysfunktionell familj samlas inför ett bröllop, och gör sitt bästa för att överleva en helg som ser ut att urarta till att bli ett fullskaligt familjefiasko.', 'img/movie/thebigwedding.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1931435/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=T4AxNRPAggE', 40),
(18, 'Halloween', '	John Carpenter', 91, 1978, 'Den 31 oktober 1963 tar den sexårige Michael Myers på sig en mask och mördar med kniv sin 17-åriga syster. Han hamnar på mentalsjukhus och rymmer 15 år senare på väg till en ny anstalt, och beger sig hem till Haddonfield, där han på nytt börjar mörda.', 'img/movie/halloween.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0077651/', 'http://www.youtube.com/watch?v=waTkW-UFyl4', 20),
(19, 'The Internship', 'Shawn Levy ', 119, 2013, 'Vince Vaughn och Owen Wilson spelar två äldre säljare som efter att ha fått sparken inser att de är dinosaurier i dagens digitala värld. I hopp om att starta om lyckas de bluffa sig till två eftertraktade praktikplatser på Google med efterföljande kaos som resultat.', 'img/movie/theinternship.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt2234155/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=cdnoqCViqUo', 50),
(20, 'The Lone Ranger', 'Gore Verbinski', 149, 2013, 'Indianen och andekrigaren Tonto återberättar de okända historierna som förvandlade John Reid, en lagens man, till en rättvisans legend. Historierna är fyllda med stora överraskningar och massor med humor när de två oväntade hjältarna måste lära sig att samarbeta och kämpa mot korruption och girighet.', 'img/movie/theloneranger.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1210819/?ref_=nv_sr_1', 'http://www.youtube.com/results?search_query=the+lone+ranger+trailer&sm=3', 50),
(21, 'Inception', 'Christopher Nolan', 148, 2010, 'Dom Cobb är en skicklig tjuv, den absolut bästa i den farliga konsten i att extrahera: att stjäla värdefulla hemligheter från djupt inne i det undermedvetna under drömstadiet när hjärnan är som mest känslig. Cobbs ovanliga förmåga har gjort honom till en åtråvärd spelare i denna förrädiska nya värld av industrispionage, men det har också gjort honom till en internationell flykting och kostat honom allt han någonsin älskat. Nu erbjuds Cobb en chans till försoning. Ett sista jobb skulle kunna ge honom tillbaka hans liv men bara om han kan uppnå det omöjliga – inception. Istället för den perfekta stöten, så måste Cobb och hans grupp av specialister lyckas med det omvända; deras uppgift är inte att stjäla en idé utan istället att plantera en. Om de lyckas så skulle det kunna vara det perfekta brottet. Men hur mycket planering och expertis de än har så kan inget förebereda gruppen på den farliga fienden som verkar förutse alla deras drag. En fiende bara Cobb kunde ha förutsett.', 'img/movie/inception.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1375666/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=8hP9D6kZseM', 40),
(22, 'Sagan om konungens återkomst', 'Peter Jackson', 201, 2003, 'Den avslutande delen i trilogin om Härskarringen. Aragorn återvänder till Gondor, för att leda sitt folk i det sista slaget mot ondskans makter. Samtidigt närmar sig Sam och Frodo Domedagsberget och sitt mål att förstöra Ringen. Men de har ett förrädiskt resesällskap. ', 'img/movie/saganomkonungensaterkomst.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0167260/', 'http://www.youtube.com/watch?v=r5X-hFf6Bwo', 40),
(23, 'Breaking Dawn - Part 2', 'Bill Condon', 115, 2012, 'Bella är nu en vampyr men hon har aldrig känt sig mer levande. Inte nog med att hon har fått sin Edward och dottern Renesmee – som vampyr kan hon vara tillsammans med båda två i all evighet! Endast Jacob Blacks starka band till Renesmee oroar Bella. Utan hennes och Edwards vetskap blir just dottern den katalysator som hotar att tillintetgöra dem alla!The Twilight-saga får sin episka avslutning i detta actionspäckade sista kapitel som är regisserat av Bill Condon. Återvänd för sista gången till Forks och till den värld som med all säkerhet kommer att leva för evigt i oss allihop.', 'img/movie/breakingdawn2.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1673434/?ref_=tt_rec_tt', 'http://www.youtube.com/watch?v=2DYH2t8fCqo', 40),
(24, 'Man of Steel', 'Zack Snyder', 143, 2012, 'Kal-El, sista sonen av Krypton, adopteras som barn av Jonathan och Martha Kent på Jorden. Hans unika superkrafter håller honom länge från att hitta en plats i samhället, tills en dag då Jorden attackeras och han tar upp manteln som Stålmannen och beskyddar sin adoptivplanet.', 'img/movie/manofsteel.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0770828/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=T6DJcgm3wNY', 50),
(25, 'Fjällbackamorden: Strandridaren', 'Rickard Petrelius', 90, 2013, 'Två djuphavsdykare hittas döda efter en storm. Strax efter hittas ordföranden för Kungshamns Skeppsmuseum mördad. När Erica börjar undersöka saken upptäcker hon att alla tre dödsfallen har kopplingar till ett skeppsvrak från 1820 tillsammans med en hemlighet. ', 'img/movie/fjallbackamorden.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt2188743/?ref_=nv_sr_4', 'https://www.headweb.com/sv/446000/fjallbackamorden-strandridaren', 50),
(26, 'Berättelsen om Narnia: Häxan och lejonet', 'Andrew Adamson', 143, 2005, 'Vi får följa de fyra syskonen Pevensie - Lucy, Edmund, Susan och Peter - som lever i andra världskrigets England. Under en kurragömmalek på det stora godset, som ägs av en mystisk professor, kommer de in i landet Narnia genom en magisk garderob. Där upptäcker barnen ett vackert, och en gång fridfullt land som befolkas av talande bestar, dvärgar, fauner, kentaurer och jättar. Den elaka vita häxan Jadis förbannelse vilar över landet och det är evig vinter - men aldrig jul. Under ledning av den ädle och mystiske härskaren, det magnifika lejonet Aslan, kämpar barnen för att besegra Jadis. I en spektakulär och storslagen strid står till slut slaget om Narnia, ett slag som kan befria Narnia från den vita häxans iskalla förbannelse för evigt. Efter en roman av C S Lewis.', 'img/movie/narnia.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt0363771/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=lWKj41HZBzM', 30),
(27, 'Känn ingen sorg', 'Måns Mårlind, Björn Stein', 119, 2013, 'Den musikaliske Pål drömmer om att lyckas med sin musik, men han har ett stort hinder, sig själv. Han är en oslipad diamant och det enda som är större än hans musikaliska förmåga är hans tvångstankar som konstant försätter honom i problem. Vi följer Pål och hans kamrater i en emotionell resa genom ett sommar-Göteborg där Pål kastas mellan kärlek och svek, förälskelse och försoning.', 'img/movie/kann-ingen-sorg.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt2429292/?ref_=fn_al_tt_1', 'http://www.youtube.com/watch?v=5FqkRSAbkFQ', 50),
(28, 'Great Gatsby', 'Baz Luhrmann', 142, 2013, 'Handlingen kretsar kring Nick Carraway som med författardrömmar kommer till New York våren 1922, en tid som präglades av dekadens, glittrande jazz, alkoholförbud och en överhettad aktiemarknad. Nick träffar miljonären Gatsby och dras in i överklassens fängslande värld av illusioner, omöjlig kärlek och svek.', 'img/movie/gatsby.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1343092/?ref_=nv_sr_1', 'http://www.youtube.com/watch?v=vuQhprtLJ3k', 50),
(29, 'Hunger Games', 'Gary Ross', 137, 2012, 'En gastkramande framtid som är grym, rå, falsk och egentligen bara handlar om en sak - att hålla folket i schack. Varje år direktsänds Hunger games som en av de största mediala händelserna. Från varje distrikt lottas två ungdomar mellan tolv och arton ut att delta i tävlingen. De skickas omedelbart till huvudstaden där de ska stylas, tränas och visas upp i direktsända intervjuer, för att sedan delta i spelet där bara en vinner  den som överlever. Katniss Everdeen är fjorton år. Hon älskar sin lillasyster Prim över allt annat, och försöker skydda henne från allt hemskt i distrikt tolv, men mot Hunger games har hon inget skydd. När det är Prims namn som dras i lottningen ser Katniss ingen annan utväg än att själv ta Prims plats i spelen.', 'img/movie/hunger-games.jpg', NULL, NULL, NULL, NULL, 'http://www.imdb.com/title/tt1392170/?ref_=nv_sr_2', 'http://www.youtube.com/watch?v=4S9a5V9ODuY', 50),

-- --------------------------------------------------------

--
-- Table structure for table `Movie2Genre`
--

CREATE TABLE `Movie2Genre` (
  `idMovie` int(11) NOT NULL,
  `idGenre` int(11) NOT NULL,
  PRIMARY KEY (`idMovie`,`idGenre`),
  KEY `idGenre` (`idGenre`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Movie2Genre`
--

INSERT INTO `Movie2Genre` (`idMovie`, `idGenre`) VALUES
(2, 1),
(5, 1),
(6, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(13, 1),
(23, 1),
(27, 1),
(28, 1),
(30, 1),
(11, 2),
(27, 2),
(30, 2),
(6, 3),
(7, 3),
(8, 3),
(27, 3),
(28, 3),
(30, 3),
(3, 4),
(4, 4),
(5, 4),
(12, 4),
(20, 4),
(21, 4),
(22, 4),
(23, 4),
(24, 4),
(26, 4),
(29, 4),
(1, 5),
(3, 5),
(12, 5),
(15, 5),
(26, 5),
(29, 6),
(14, 7),
(16, 7),
(18, 7),
(29, 7),
(5, 8),
(12, 8),
(15, 8),
(2, 9),
(10, 9),
(11, 9),
(4, 10),
(9, 10),
(20, 10),
(21, 10),
(22, 10),
(24, 10),
(14, 11),
(16, 11),
(18, 11),
(1, 12),
(2, 12),
(7, 12),
(15, 12),
(17, 12),
(19, 12),
(20, 12),
(3, 13),
(4, 13),
(9, 13),
(22, 13),
(23, 13),
(24, 13),
(26, 13),
(13, 14),
(25, 14),
(14, 15),
(21, 15);

-- --------------------------------------------------------

--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `acronym` char(12) NOT NULL,
  `name` varchar(80) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  `salt` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `acronym` (`acronym`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`id`, `acronym`, `name`, `password`, `salt`) VALUES
(1, 'doe', 'John/Jane Doe', '2f3ce68a0906201688966edfd2a78f3b', 1405445370),
(2, 'admin', 'Administrator', '52514a566fa8a3f6a5f3c237a7c6f77f', 1405445370);

-- --------------------------------------------------------

--
-- Stand-in structure for view `vmovie`
--
CREATE TABLE `vmovie` (
`id` int(11)
,`title` varchar(100)
,`director` varchar(100)
,`length` int(11)
,`year` int(11)
,`plot` text
,`image` varchar(100)
,`subtext` char(3)
,`speech` char(3)
,`quality` char(3)
,`format` char(3)
,`imdb` varchar(100)
,`trailer` varchar(100)
,`genre` text
);
-- --------------------------------------------------------

--
-- Structure for view `vmovie`
--
DROP TABLE IF EXISTS `vmovie`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vmovie` AS select `M`.`id` AS `id`,`M`.`title` AS `title`,`M`.`director` AS `director`,`M`.`length` AS `length`,`M`.`year` AS `year`,`M`.`plot` AS `plot`,`M`.`image` AS `image`,`M`.`subtext` AS `subtext`,`M`.`speech` AS `speech`,`M`.`quality` AS `quality`,`M`.`format` AS `format`,`M`.`imdb` AS `imdb`,`M`.`trailer` AS `trailer`,group_concat(`G`.`name` separator ',') AS `genre` from ((`movie` `M` left join `movie2genre` `M2G` on((`M`.`id` = `M2G`.`idMovie`))) left join `genre` `G` on((`M2G`.`idGenre` = `G`.`id`))) group by `M`.`id`;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Movie2Genre`
--
ALTER TABLE `Movie2Genre`
  ADD CONSTRAINT `movie2genre_ibfk_1` FOREIGN KEY (`idMovie`) REFERENCES `Movie` (`id`),
  ADD CONSTRAINT `movie2genre_ibfk_2` FOREIGN KEY (`idGenre`) REFERENCES `Genre` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
