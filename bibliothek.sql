-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2024 at 12:52 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliothek`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `AdminID` int(11) NOT NULL,
  `Vorname` varchar(50) DEFAULT NULL,
  `Nachname` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Passwort` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `buecher`
--

CREATE TABLE `buecher` (
  `BuchID` int(11) NOT NULL,
  `Titel` varchar(255) DEFAULT NULL,
  `Beschreibung` text DEFAULT NULL,
  `Autor` varchar(100) DEFAULT NULL,
  `Veroeffentlichungsdatum` date DEFAULT NULL,
  `Preis` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buecher`
--

INSERT INTO `buecher` (`BuchID`, `Titel`, `Beschreibung`, `Autor`, `Veroeffentlichungsdatum`, `Preis`) VALUES
(1, 'Ein Sommer in London', 'Fontanes Blick auf die Weltstadt an der Themse\r\nIn seinem ersten Prosaband kombiniert Fontane geschickt seine eigenen Erfahrungen aus dem Sommer 1852 ', ' Theodor Fontane', '1954-09-12', 39.99),
(2, 'Die Rettung', 'Der neue Band der großen Anna-Seghers-Werkausgabe – »Eine Chronik der deutschen Arbeitslosen« Walter Benjamin\r\nNach einem »wilden Feuer« in dem obersc', 'Walter Benjamin', '2014-12-10', 45.99),
(3, 'Café Continental\r\nGeschichten und Plaudereien an Marmortischen', 'Bernd-Lutz Lange nimmt uns mit ins Café Continental – und zugleich mit auf eine literarische Reise durch die letzten 60 Jahre, mit leisem Humor', 'Bernd-Lutz Lange', '2014-04-17', 50.99),
(4, 'Das Lied eines Mörders', 'Die Mafia, wie sie noch niemand erzählt hat: die intime Beichte eines Mörders.\r\nIn seinem fulminanten Roman porträtiert der italienische Autor Giosuè Calaciura einen Auftragskiller, der sich aus den kriminellen Strukturen, denen er verhaftet ist, auch men', 'Giosuè Calaciura', '2024-05-23', 35.99),
(5, 'Der Frühling ist in den Bäumen', '1. Mai 1953, Konstanz am Bodensee: Renina ist vierundzwanzig, Martin Heideggers jüngste Assistentin und wagt den Sprung in die Selbstständigkeit. Sie gründet die erste Frauenzeitschrift Deutschlands. In Zeiten beängstigender politischer Restauration will sie sich mit ihrer »Lady« für ein neues Rollenverständnis der Frau einsetzen. Die Zeichen stehen gut, wäre da nicht Fred, den sie aus einer Laune heraus geheiratet hat. Der Doktor der Atomphysik, Neffe von Marlene Dietrich, hat sie in gefährliche sexuelle Abhängigkeiten verstrickt.\r\nVor der malerischen Kulisse des Bodensees verändert sich an einem einzigen Tag Reninas Leben ...', 'Jana Revedin', '2023-05-16', 40.99),
(6, 'Weiße Nächte, weites Land', 'Deutschland im 18. Jahrhundert. Nach dem Ende des siebenjährigen Krieges herrscht in dem kleinen Dorf Waidbach in Hessen Hoffnungslosigkeit. Die Schwestern Christina, Eleonora und Klara Weber leiden nach dem Tod ihrer Mutter besonders in der schwierigen Lage. Der Ruf Katharinas der Großen, in Russland ein neues Leben zu beginnen, kommt gerade recht. Angezogen von großartigen Versprechungen auf Land und Geld machen sich die Schwestern, die unterschiedlicher nicht sein könnten, gemeinsam auf die Reise. Doch die Wirklichkeit entspricht weder ihren Erwartungen noch ihren Hoffnungen. Sie erweist sich vielmehr als rau und grausam: Statt eines sorgenfreien Lebens in Wohlstand erwarten die Schwestern zunächst kalte Winter und schwere Arbeit. Werden sie es schaffen, sich an der Wolga ein neues, besseres Leben aufzubauen?\r\nEine historische Familiensaga vor dem Hintergrund der Deutsch-Russischen Geschichte\r\nMartina Sahler überzeugt mit vielschichtigen Protagonistinnen, ihrem einfühlsamen Schreibs', 'Martina Sahler', '2024-04-19', 35.00),
(7, 'Dunkle Wälder, ferne Sehnsucht', 'Das große Abenteuer an der Wolga geht weiter!\r\n»Dunkle Wälder, ferne Sehnsucht« ist der zweite Teil der mitreißenden Auswanderer-Trilogie über drei mutige Schwestern und ihr dramatisches Familien-Schicksal von der SPIEGEL-Bestsellerautorin Martina Sahler!\r\nRussland 1780. Seitdem die Weber-Schwestern ihr Heimatdorf in Hessen verlassen haben, sind vierzehn Jahre vergangen. Im fernen Russland haben sie mit anderen Auswanderern eine deutsche Siedlung gegründet, doch Eleonora lebt inzwischen in Saratow, Christina hat sich ihr Leben in der russischen Hauptstadt aufgebaut, und nur Klara ist in der Einwanderer-Siedlung geblieben. Im weiten Land an der Wolga hält das Schicksal große Herausforderungen für die kämpferischen Frauen bereit.\r\nFür Band 1 der Auswanderer-Trilogie Weiße Nächte, weites Land erhielt Martina Sahler den HOMER-Literaturpreis in Silber in der Kategorie Biographie/historisches Ereignis. Auch im zweiten Band der Wolgasiedler-Trilogie überzeugt sie mit ihrem mitreißenden Schrei', 'Martina Sahler', '2022-11-23', 49.99),
(8, 'Die Magie goldgewebter Herzen', 'Cosy Fantasy und eine queere Liebe, die zu Tränen rührt\r\nDie Welt lag ihm zu Füßen, aber Noel wollte nur das hier: Nur Luciens Blick auf ihm, ein warmes Heim und Musik im Takt seines Herzens.\r\nRomantische Cosy Fantasy über die Liebe zum Partner, zur Familie und zu sich selbst\r\nWie ein unsichtbares Netz durchweben magische Fäden die Welt von Brinon und verbinden auch Familien miteinander. Wenn eine Person stirbt, muss jemand an ihre Stelle treten, um das magische Gewebe zu erhalten – ansonsten drohen schwere Konsequenzen.\r\nFür Lucien, der Magie sehen und hören kann, ist der unerwartete und viel zu frühe Tod seiner Zwillingsschwester Celine eine doppelte Herausforderung: Er muss sein idyllisches Landgut Cinq Soleils verlassen, das ihm Schutz vor der Welt bietet, und zur Beerdigung seiner letzten Verwandten in die Großstadt Villeneuf reisen, die für seine empfindsamen Sinne die reinste Qual ist. \r\nUnd all das nur, weil die Magie ihn verpflichtet, den Platz seiner Schwester einzunehmen und', 'Eleanor Bardilac', '2023-06-03', 50.99),
(9, 'Jade Legacy - Ehre ist alles', 'Episch, brillant und spektakulär actionreich: In »Jade Legacy – Ehre ist alles«, dem sensationellen Finale von Fonda Lees Fantasy-Trilogie »Die Jade-Saga«, erreicht der Kampf um Ehre, Macht und magische Jade seinen Höhepunkt.\r\nLängst giert die ganze Welt nach der magischen Jade, die einst nur den Grünblut-Kriegern vorbehalten war: Jeder will seinen Nutzen aus den übernatürlichen Fähigkeiten ziehen, die sie verleiht.\r\nDer Krieg um die Jade hat die Insel Kekon ebenso gezeichnet wie die Geschwister der Familie Kaul. Dennoch werden Hilo, Shae und Anden noch grausamere Opfer abverlangt. Und wenn es ihnen nicht gelingt, zwischen Freund und Feind zu unterscheiden und einen neuen Weg aus den blutigen Rivalitäten der Clans zu finden, ist nicht nur ihre Familie dem Untergang geweiht. Dann werden selbst die unzertrennlichen Bande von Ehre und Loyalität nicht reichen, um ihre Heimat zu retten, die zu schützen sie geschworen haben.\r\n»Jade City«, der erste Teil der »Jade-Saga«, wurde von der TIME zu', ' Fonda Lee', '2020-12-22', 46.99),
(10, 'Shogun', 'Der große historische Roman über die Einigung Japans und den Aufstieg des Shōgunats — jetzt neu verfilmt als Blockbuster-Serie bei Disney+\r\nIm Jahr 1600 strandet der englische Navigator John Blackthorne an der Küste eines Landes, das erst wenige Europäer erreicht haben: Japan.\r\nBlackthorne bleibt nur wenig Zeit, um sich in der fremden Sprache und Kultur zurechtzufinden. Und er muss seine Vorstellungen von Loyalität, Mut und Moral hinterfragen.\r\nSchon bald gerät er mitten hinein in den Machtkampf der japanischen Fürsten, der das Land zu zerreißen droht. Blackthorne tritt in den Dienst des faszinierenden Strategen Toranaga. Doch als er sich in die Übersetzerin Mariko verliebt — die Frau eines Samurais in Toranagas Diensten — wird seine Loyalität auf eine harte Probe gestellt.\r\nIn einem Land, das sich unaufhaltsam wandelt, hängt nicht nur Blackthornes Überleben davon ab, dass er die richtigen Entscheidungen trifft. Denn nur einer der rivalisierenden Fürsten kann siegreich sein und Shōgun ', 'James Clavell', '2014-04-08', 24.00),
(11, 'Das Meer der Lügen', '\r\nder erste Roman aus Diana Gabaldons historischer Bestseller-Reihe um die beliebteste Nebenfigur der Outlander-Saga, Lord John Grey.\r\n\r\nDer britische Offizier Lord John Grey ist eben erst aus dem schottischen Exil nach Hause zurückgekehrt, als ihn im London des Jahres 1757 neues Ungemach erwartet: Er erhält den prekären Auftrag, vertrauliche Papiere aufzuspüren, die der britischen Armee gestohlen wurden – vermutlich von einem der eigenen Soldaten!\r\n\r\nDazu kommt, dass der Ehrenwerte Joseph Trevelyan, der Verlobte von Lord Johns Cousine, ein Doppelleben zu führen scheint. Um seine Familie vor einem Skandal zu schützen, folgt Lord John so diskret wie möglich den rätselhaften Spuren Trevelyans – und gerät dabei nicht nur in Lebensgefahr, sondern muss auch sein eigenes Verständnis von Moral, Liebe und Loyalität in Frage stellen.\r\n\r\nZum Mitfiebern spannend entführt Diana Gabaldon in »Das Meer der Lügen« ins ebenso quirlige wie brutale London des 18. Jahrhunderts, wo der queere Lord John Gre', 'Diana Gabaldons', '2016-07-06', 29.00),
(12, 'Mord im Orientexpress Ein Fall für Poirot', 'Nach einigen Mühen hat Hercule Poirot ein Abteil im Kurswagen Istanbul - Calais des Luxuszugs ergattert. Doch auch jetzt ist ihm keine Ruhe vergönnt: Ein amerikanischer Tycoon ist ermordet worden, der ganze Zug voller Verdächtiger. Und der Mörder könnte jederzeit wieder zuschlagen. \r\nEine Aufgabe, wie gemacht für den Meisterdetektiv.', 'Agatha Christie', '2016-07-15', 34.99),
(13, 'Das Geheimnis des Weihnachtspuddings Geschichten zum Fest', 'Weihnachten bei Agatha Christie - dazu gehören natürlich Hercule Poirots graue Zellen und Miss Marples unverwüstliche Neugier: wenn etwa im Weihnachtspudding ein Rubin versteckt ist oder zum Fest der Liebe ein gerissener Mord passiert. Aber auch ohne ihre beiden Lieblingsfiguren kann Agatha Christie wunderbar von Weihnachten erzählen und dabei sogar eine Krimi- mit einer Liebesgeschichte kombinieren. Und dann zeigen zwei ganz und gar nicht kriminelle, sondern besinnliche Geschichten die Autorin von einer gänzlich ungewohnten Seite. Und als Zugabe gibt es noch eine ganz persönliche Weihnachtserinnerung der Queen of Crime.', 'Agatha Christie', '2018-12-19', 30.99),
(14, 'Das große Hercule-Poirot-Buch. Die besten Kriminalgeschichten', 'Die spannendsten Kriminalgeschichten mit Agatha Chrisities beliebtester Figur - Hercule Poirot. Mit seinen unorthodoxen Methoden hat der elegante Belgier mit dem scharfen Blick und dem adrett gezwirbelten Schnurrbart noch jedes Rätsel gelöst. In den hier versammelten Erzählungen und Novellen sieht sich Poirot mit blutigen Morden, Giftanschlägen, Entführungen und Diebstählen konfrontiert - und löst sie mit dem für ihn typischen Spürsinn.', 'Agatha Christie', '2017-12-12', 40.99),
(15, 'Der Tod wartet Ein Fall für Poirot', '\"Du siehst doch ein, dass sie sterben muss.” \r\nDiesen Satz, den Raymond Boynton an seine Schwester richtet, hört Hercule Poirot zufällig in seinem Jerusalemer Hotel mit. Als Mrs Boynton, die tyrannische Stiefmutter der Geschwister, wenig später auf dem Weg nach Petra ermordet wird, erinnert sich Poirot an die verschwörerischen Worte. Er hat nur 24 Stunden, um den Fall zu lösen. \r\nGenug Zeit jedoch, um Überraschendes zu Tage zu fördern ...', 'Agatha Christie', '1999-10-20', 40.99),
(16, 'Der blaue Express Ein Fall für Poirot', 'Hercule Poirot ermittelt nicht nur im Orientexpress ...\r\nDer Fahrplan stimmt, der Zeitplan auch. Poirot reist an die Riviera – natürlich mit dem Luxuszug von Calais über Paris nach Nizza. Auch die reiche amerikanische Erbin Ruth Kettering fährt mit dem »Blauen Express«, doch als der Schaffner in Nizza an ihr Abteil klopft, findet er eine Leiche. Ein perfekter Mord – so scheint es. Doch eine kleine Unstimmigkeit lässt Hercule Poirots kleine graue Zellen nicht mehr ruhen: Die Frage nämlich, warum das Gesicht der jungen Frau entstellt wurde.', 'Agatha Christie', '2018-12-18', 40.99),
(18, 'El Principito', 'Ist die Geschichte von ein Kind, das in ein andere Planet wohnt', 'Antoine de Saint-Exupéry', '1943-04-12', 30.99),
(19, 'Rügensünde', 'Tödliche Klippen.\r\n\r\nRügen in den 1920er Jahren. Der Brand ihres Elternhauses lässt die Krimiautorin Dorothee von Stresow nicht mehr los. Sie setzt alles daran, die Brandstifter von damals zu finden, doch die Ankunft einer Filmcrew aus Berlin bereitet ihrem Vorhaben ein abruptes Ende. Als das Starlet Lily di Mario tot am Fuße einer Klippe aufgefunden wird, bittet Kommissar Breesen um Dorothees Mithilfe. Doch die Schauspielerin ist nicht die einzige Tote, die das Filmset fordert. Also plant Dorothee, dem Mörder eine Falle zu stellen …\r\n\r\nDer zweite Fall der ungewöhnlichen Ermittlerin Dorothee von Stresow.', 'Sylvia Frank', '2024-04-11', 40.99),
(20, 'Bornholmer Geheimnis', 'Mysteriöser Tod auf Bornholm \r\nSarah Pirohl, Ermittlerin auf Bornholm, bekommt von der deutschen Polizei einen besonderen Auftrag: Auf der dänischen Insel ist Monica Seffgen, die aus Flensburg stammt, auf dem Weg zum Strand überfallen und getötet worden. Sarah findet heraus, dass Monica meistens für sich blieb und sehr wohlhabend war. In Deutschland war sie bei einem Senioren-Service beschäftigt. Ihr letzter Patient war ein ehemaliger hochrangiger Marineoffizier. Und offenbar haben sich auch Geheimdienste für ihre Arbeit interessiert. Könnte Monica Seffgen eine Spionin gewesen sein? \r\nAktuell und temporeich – der neue Krimi von SPIEGEL-Bestsellerautorin Katharina Peters', ' Katharina Peters', '2024-10-23', 20.99),
(21, 'Der Tod auf dem Nil', 'Hercule Poirot freut sich auf eine erholsame Kreuzfahrt auf dem Nil. Doch dazu kommt es nicht. Auch Linnet Ridgeway hat sich den Verlauf ihrer Flitterwochen wohl anders vorgestellt. Die junge, bildschöne Millionenerbin wird tot aufgefunden, und Poirots Ermittlungskünste sind gefragt. Fast jeder der Mitreisenden hat ein Motiv.', 'Agatha Christie', '2024-09-19', 30.99),
(23, 'Die Tote in der Bibliothek ', 'Es ist sieben Uhr morgens. In der Bibliothek der Bantrys liegt eine Leiche in einem Abendkleid. Wer ist sie? Wie kommt sie hierher? Fragen, auf die weder der Colonel noch seine Frau eine Antwort wissen. Vielleicht kann eine Freundin von Mrs. Bantry helfen - Jane Marple macht sich sofort auf die Jagd. Schnell ist die Leiche identifiziert und das Motiv erkannt: Es ging um Geld, viel Geld.   Die beiden Damen quartieren sich im Majestic Hotel in Danemouth ein, wo Miss Marple den Täter zur Strecke bringen will - mit viel Gespür und noch mehr Verstand.', 'Agatha Christie', '1942-02-07', 20.99),
(24, 'Vier Frauen und ein Mord', 'Mrs McGinty, eine liebenswürdige, vielleicht etwas geschwätzige alte Dame, wurde kaltblütig ermordet. Schnell wird ihr Untermieter für die Tat verhaftet, doch wirkt er keineswegs wie ein Mörder, höchstens etwas verschroben. McGinthy schrieb kurz vor ihrem Tod einen Brief an die Zeitung. Ein Artikel über vier Verbrecherinnen hatte ihre Aufmerksamkeit erregt. Bedeutete dieser Brief ihr Todesurteil? Hercule Poirot und Ariadne Oliver rollen den Fall neu auf.', 'Agatha Christie', '2018-12-12', 30.99),
(25, 'Mord nach Maß', 'Ein maßgeschneidertes Idyll - ein verfluchter Ort  Dem Arbeiter Mike Rogers scheint der soziale Aufstieg mit links zu glücken: Er heiratet in eine reiche Familie ein und erfüllt sich den Traum vom eigenen Haus auf einem großzügigen Anwesen. Doch je größer das Idyll, desto stärker droht Zerstörung: Plötzlich verunfallt seine Frau auf rätselhafte Weise und “was wie eine Romanze anfängt, geht in schier unerträgliche Spannung über und mündet in das wohl schockierendste Romanende, das diese überraschende Autorin jemals inszeniert hat“ (The Guardian).', 'Agatha Christie', '1956-11-23', 30.99),
(26, 'Rügentod', 'Das Feuer von Rügen.  Rügen in den zwanziger Jahren. Das Kurhaus in Binz ist das erste Haus am Platz. Hier steigt die erfolgreiche Krimiautorin Dorothee von Stresow ab. Seit ihre Eltern bei einem Brand auf dem Gut ihrer Familie vor achtzehn Jahren ums Leben kamen, ist Dorothee nicht mehr auf der Insel gewesen. Nun trifft sie auf einem Empfang ihre Freundin Margarethe wieder, die Andeutungen macht, sie wisse etwas über das Feuer von damals. Schon am nächsten Tag wird ein Anschlag auf Dorothee verübt – und ihre Freundin liegt tot in einer Jagdhütte.', NULL, '0000-00-00', 0.00),
(27, 'Freiheit', 'Die lange erwarteten Erinnerungen von Angela Merkel. 16 Jahre trug Angela Merkel die Regierungsverantwortung für Deutschland, führte das Land durch zahlreiche Krisen und prägte mit ihrem Handeln und ihrer Haltung die deutsche und internationale Politik und Gesellschaft. Doch natürlich wurde Angela Merkel nicht als Kanzlerin geboren. In ihren gemeinsam mit ihrer langjährigen politischen Beraterin Beate Baumann verfassten Erinnerungen schaut sie zurück auf ihr Leben in zwei deutschen Staaten – 35 Jahre in der DDR, 35 Jahre im wiedervereinigten Deutschland. Persönlich wie nie zuvor erzählt sie von ihrer Kindheit, Jugend und ihrem Studium in der DDR und dem dramatischen Jahr 1989, in dem die Mauer fiel und ihr politisches Leben begann. Sie lässt uns teilhaben an ihren Treffen und Gesprächen mit den Mächtigsten der Welt und erhellt anhand bedeutender nationaler, europäischer und internationaler Wendepunkte anschaulich und präzise, wie Entscheidungen getroffen wurden, die unsere Zeit prägen. Ihr Buch bietet einen einzigartigen Einblick in das Innere der Macht – und ist ein entschiedenes Plädoyer für die Freiheit.', 'Angela Merkel', '2024-11-26', 41.99);

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `kaeufe`
--

CREATE TABLE `kaeufe` (
  `KaufID` int(11) NOT NULL,
  `KundenID` int(11) DEFAULT NULL,
  `BuchID` int(11) DEFAULT NULL,
  `Kaufdatum` date DEFAULT NULL,
  `Betrag` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `korb`
--

CREATE TABLE `korb` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kunden`
--

CREATE TABLE `kunden` (
  `KundenID` int(11) NOT NULL,
  `Vorname` varchar(50) DEFAULT NULL,
  `Nachname` varchar(50) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Passwort` varchar(100) DEFAULT NULL,
  `Registrierdatum` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `buecher`
--
ALTER TABLE `buecher`
  ADD PRIMARY KEY (`BuchID`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `kaeufe`
--
ALTER TABLE `kaeufe`
  ADD PRIMARY KEY (`KaufID`),
  ADD KEY `KundenID` (`KundenID`),
  ADD KEY `BuchID` (`BuchID`);

--
-- Indexes for table `korb`
--
ALTER TABLE `korb`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `kunden`
--
ALTER TABLE `kunden`
  ADD PRIMARY KEY (`KundenID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `buecher`
--
ALTER TABLE `buecher`
  MODIFY `BuchID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kaeufe`
--
ALTER TABLE `kaeufe`
  MODIFY `KaufID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `korb`
--
ALTER TABLE `korb`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kunden`
--
ALTER TABLE `kunden`
  MODIFY `KundenID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `korb`
--
ALTER TABLE `korb`
  ADD CONSTRAINT `korb_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `kunden` (`KundenID`) ON DELETE CASCADE,
  ADD CONSTRAINT `korb_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `buecher` (`BuchID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
