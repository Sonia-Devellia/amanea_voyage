-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 08 avr. 2026 à 15:40
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `amaneav_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `ADMIN`
--

CREATE TABLE `ADMIN` (
  `Id_ADMIN` int(11) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ADMIN`
--

INSERT INTO `ADMIN` (`Id_ADMIN`, `email`, `password`, `last_login`) VALUES
(1, 'nora@amaneav.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uSh95TUR2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `ARTICLE`
--

CREATE TABLE `ARTICLE` (
  `Id_ARTICLE` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `status` enum('brouillon','publie') DEFAULT NULL,
  `publication_date` datetime DEFAULT NULL,
  `slug` varchar(200) DEFAULT NULL,
  `Id_MEDIA` int(11) DEFAULT NULL,
  `Id_ADMIN` int(11) NOT NULL,
  `Id_DESTINATION` int(11) DEFAULT NULL,
  `pexels_keyword` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ARTICLE`
--

INSERT INTO `ARTICLE` (`Id_ARTICLE`, `title`, `content`, `status`, `publication_date`, `slug`, `Id_MEDIA`, `Id_ADMIN`, `Id_DESTINATION`, `pexels_keyword`) VALUES
(4, 'Voyager dans un monde instable : pourquoi le tourisme responsable compte plus que jamais', 'Conflits régionaux, tensions géopolitiques, inflation du transport aérien, bouleversements climatiques… Le monde semble parfois plus incertain que jamais.\n\nEt pourtant, le désir de voyager reste intact.\n\nMais face à ces transformations, une question qu\'on se pose tous : comment continuer à voyager de manière responsable dans un monde qui change ?\n\nVoyager aujourd\'hui ne consiste plus simplement à « visiter un pays ». C\'est aussi comprendre les réalités économiques, culturelles et sociales des territoires que l\'on découvre.\n\nDans de nombreux pays, le tourisme représente une part essentielle de l\'économie locale : guides, chauffeurs, petits hôtels familiaux, artisans, restaurateurs.\n\nLorsque les flux touristiques diminuent brusquement à cause de crises internationales, ce sont souvent ces communautés locales qui sont les premières impactées.\n\nC\'est pourquoi le tourisme responsable prend aujourd\'hui tout son sens.\n\nChoisir des partenaires locaux, privilégier des hébergements indépendants, découvrir les cultures avec respect… Autant de gestes qui permettent de transformer un simple voyage en échange authentique.\n\nChez Amanéa, nous croyons profondément que voyager peut rester un acte positif — à condition de le faire avec curiosité, conscience et respect des territoires.', 'publie', '2026-04-02 15:48:27', 'voyager-monde-instable-tourisme-responsable', NULL, 1, NULL, NULL),
(5, 'Slow travel : pourquoi voyager moins mais mieux séduit de plus en plus', 'Pendant longtemps, voyager signifiait souvent « voir le plus de choses possible en peu de temps ».\n\nAujourd\'hui, une autre approche se développe : le slow travel.\n\nLe principe est simple : prendre le temps de découvrir un territoire plutôt que de multiplier les étapes.\n\nAu lieu de visiter cinq villes en dix jours, les voyageurs privilégieront de rester plus longtemps dans un même lieu, de rencontrer les habitants, de découvrir les traditions locales, d\'explorer la nature environnante.\n\nCette approche transforme complètement l\'expérience du voyage.\n\nOn passe moins de temps dans les transports et davantage dans la rencontre et l\'exploration réelle du territoire.\n\nLe slow travel permet aussi de réduire l\'impact environnemental du tourisme en limitant les déplacements inutiles.\n\nChez Amanéa, cette philosophie inspire la conception de nombreux itinéraires : des voyages pensés pour s\'imprégner des lieux plutôt que simplement les traverser.\n\nParce que parfois, les plus beaux souvenirs naissent lorsque l\'on prend simplement le temps d\'être là.', 'publie', '2026-04-02 16:04:24', 'slow-travel-voyager-moins-mais-mieux', NULL, 1, NULL, NULL),
(6, 'Voyager peut-il vraiment soutenir les économies locales ?', 'On parle souvent du tourisme comme d\'une industrie mondiale, avec ses chiffres, ses flux et ses grandes tendances. Mais derrière ce mot un peu abstrait se cache une réalité beaucoup plus humaine, presque invisible à première vue. Car dans de nombreuses régions du monde, voyager ne se résume pas à se déplacer d\'un lieu à un autre. C\'est aussi, et surtout, entrer dans une économie locale vivante, fragile parfois, mais essentielle.\n\nDans beaucoup de destinations, le tourisme fait vivre des milliers de personnes. Pas seulement les grandes structures que l\'on imagine en premier, mais tout un écosystème de métiers souvent discrets. Des guides passionnés qui partagent leur histoire, des artisans qui perpétuent un savoir-faire, des chauffeurs qui connaissent chaque route, des cuisiniers qui transmettent une culture à travers leurs plats, des familles qui ouvrent les portes de leurs hébergements. Chaque voyage, sans que l\'on en ait toujours conscience, active une chaîne économique locale bien réelle.\n\nLa manière dont on voyage change alors profondément l\'impact que l\'on laisse derrière soi. Lorsque l\'on privilégie des infrastructures internationales standardisées, une grande partie des revenus quitte le pays. L\'expérience peut être confortable, mais elle reste souvent déconnectée de la réalité locale. À l\'inverse, lorsque le voyage est pensé avec des partenaires ancrés sur le territoire, l\'équilibre est tout autre. Les revenus restent sur place, les activités locales continuent d\'exister, et les échanges prennent une dimension plus authentique.\n\nCe choix, parfois invisible pour le voyageur, transforme pourtant toute la dynamique du séjour. Il permet à des guides indépendants de vivre de leur expertise, à des artisans de continuer à créer, à des hébergements à taille humaine de perdurer face à des modèles plus standardisés. Il contribue aussi à maintenir des équilibres locaux, en valorisant des territoires autrement que par une logique de volume.\n\nVoyager devient alors bien plus qu\'une expérience personnelle. C\'est un acte qui, à son échelle, soutient une économie, participe à préserver des cultures et encourage des formes de tourisme plus respectueuses. Un échange, dans le sens le plus simple et le plus juste du terme.\n\nC\'est aussi dans cette logique que certains choix prennent tout leur sens. Prendre le temps de rencontrer, de comprendre, de privilégier des acteurs locaux, ce n\'est pas seulement enrichir son voyage. C\'est lui donner une portée différente, plus consciente.\n\nChez Amanéa, cette approche fait partie intégrante de la manière de concevoir chaque itinéraire. Travailler avec des partenaires locaux, des experts de terrain, ce n\'est pas un détail. C\'est une manière de voyager autrement, en restant fidèle à l\'idée que découvrir un pays, c\'est aussi soutenir ceux qui y vivent.', 'publie', '2026-04-02 16:10:36', 'voyager-soutenir-economies-locales', NULL, 1, NULL, NULL),
(7, 'Voyage de noces : créer une lune de miel unique, entre expériences inoubliables et destinations d\'exception', 'Le voyage de noces reste l\'un des voyages les plus marquants d\'une vie. Il symbolise une transition, un moment suspendu, une parenthèse à deux que l\'on imagine souvent parfaite. Pourtant, aujourd\'hui, de nombreux couples ne recherchent plus simplement une destination \"carte postale\" ou un hôtel en bord de mer. Ils aspirent à une expérience plus personnelle, plus intime, presque fondatrice.\n\nCréer une lune de miel unique ne tient pas uniquement à la destination choisie, mais à la manière dont le voyage est pensé. C\'est une question de rythme, d\'émotions, de souvenirs à construire. Certains couples rêvent de lenteur et de contemplation, d\'autres d\'aventure douce ou de découvertes culturelles. Et souvent, le plus beau voyage naît d\'un équilibre entre ces différentes envies.\n\nRemonter le Nil à bord d\'une dahabieh en Égypte, par exemple, offre une expérience à la fois paisible et profondément immersive. Le fleuve impose son tempo, les paysages défilent lentement et les temples anciens apparaissent comme hors du temps. C\'est un voyage presque silencieux, où chaque instant semble s\'étirer, idéal pour se retrouver loin du monde.\n\nPlus à l\'est, le Sri Lanka dévoile une autre forme de voyage de noces, plus végétale, plus sensorielle. Entre temples nichés dans la jungle, plantations de thé et plages sauvages, l\'île invite à une exploration douce, ponctuée de rencontres et de moments suspendus. On y passe facilement d\'une immersion culturelle à une parenthèse balnéaire, dans un équilibre naturel.\n\nEn Afrique australe, le voyage prend une dimension différente. Partir en safari, observer la faune dans son environnement naturel, partager un coucher de soleil dans une réserve privée… ces expériences créent des souvenirs puissants, presque irréels. Le contraste entre l\'intensité des journées et la sérénité des lodges en pleine nature renforce cette sensation d\'exception.\n\nD\'autres destinations, plus confidentielles, offrent aussi des cadres idéaux pour une lune de miel intime. Certaines îles de l\'océan Indien, moins connues, permettent de vivre une expérience plus authentique, loin des grands complexes hôteliers. Des hébergements à taille humaine, intégrés dans la nature, où le luxe se traduit davantage par le calme, l\'espace et la simplicité.\n\nCe qui rend un voyage de noces véritablement unique, ce n\'est donc pas seulement le lieu, mais l\'histoire qu\'il raconte. Les moments inattendus, les paysages qui marquent, les rencontres, les silences partagés. Autant d\'éléments qui transforment un séjour en un souvenir durable.\n\nPenser une lune de miel aujourd\'hui, c\'est accepter de sortir des modèles standards pour créer un voyage sur mesure, aligné avec l\'histoire du couple. Un voyage qui ne cherche pas à impressionner, mais à toucher.\n\nChez Amanéa, chaque voyage de noces est imaginé dans cette logique. Prendre le temps de comprendre les envies, construire un itinéraire cohérent, privilégier des lieux et des expériences qui ont du sens. Parce que certaines aventures ne se répètent pas, et méritent d\'être vécues pleinement.', 'publie', '2026-04-02 16:13:04', 'voyage-de-noces-lune-de-miel-unique-experiences-destinations', NULL, 1, NULL, NULL),
(8, 'Et si le lieu faisait tout le voyage', 'On pense souvent qu\'un voyage se construit autour des destinations.\n\nLes villes que l\'on visite, les paysages que l\'on découvre, les activités que l\'on enchaîne.\n\nEt pourtant, il y a autre chose, plus discret.\n\nLe lieu où l\'on dort.\n\nCelui où l\'on se réveille.\n\nCelui où l\'on ralentit sans même s\'en rendre compte.\n\nUn hébergement ne se résume pas à une chambre.\n\nC\'est une atmosphère, une manière d\'habiter un endroit, un rythme qui s\'impose doucement.\n\nUne maison ouverte sur la nature. Un éco-lodge caché. Une adresse tenue par des personnes qui prennent le temps.\n\nCe sont souvent ces lieux-là qui transforment un voyage.\n\nParce qu\'ils invitent à faire moins.\n\nÀ rester un peu plus longtemps.\n\nÀ observer, plutôt qu\'à courir.\n\nDans un monde où tout s\'accélère, le choix d\'un hébergement devient presque un choix de tempo.\n\nCertains lieux apaisent immédiatement.\n\nD\'autres reconnectent, sans bruit, à l\'essentiel.\n\nChez Amanéa, c\'est souvent par là que commence la création d\'un voyage.\n\nTrouver les endroits justes.\n\nCeux qui ne se contentent pas d\'accueillir, mais qui offrent une véritable parenthèse.\n\nParce qu\'au fond, un voyage ne se vit pas seulement à l\'extérieur.\n\nIl se vit aussi dans les lieux où l\'on s\'arrête.', 'publie', '2026-04-02 16:17:13', 'et-si-le-lieu-faisait-tout-le-voyage', NULL, 1, NULL, NULL),
(9, 'Cap-Vert : une destination encore préservée entre randonnées, plages et culture', 'Le Cap-Vert est une destination encore peu connue des voyageurs, et c\'est précisément ce qui fait toute sa singularité. Situé au large de l\'Afrique de l\'Ouest, cet archipel séduit par la diversité de ses paysages, son authenticité et une sensation de voyage intact, loin du tourisme de masse. Ici, chaque île possède sa propre identité, ce qui permet de vivre plusieurs expériences au sein d\'un même voyage, sans jamais ressentir de répétition.\n\nCertaines îles dévoilent des plages de sable fin et des eaux turquoise, idéales pour se reposer et profiter d\'un cadre naturel préservé. D\'autres, comme Santo Antão, offrent des reliefs volcaniques impressionnants, des vallées verdoyantes et des sentiers de randonnée parmi les plus spectaculaires d\'Afrique. Ce contraste permanent entre nature brute et douceur du littoral fait du Cap-Vert une destination particulièrement riche pour les voyageurs en quête d\'équilibre entre exploration et détente.\n\nAu-delà de ses paysages, le Cap-Vert se distingue aussi par son atmosphère culturelle, notamment à Mindelo, sur l\'île de São Vicente. Cette ville portuaire, souvent considérée comme le cœur culturel du pays, est profondément marquée par la musique et l\'histoire locale. L\'héritage de Cesária Évora y est encore très présent, et il n\'est pas rare de découvrir des concerts improvisés ou des bars animés en soirée. Mindelo incarne une autre facette du Cap-Vert, plus vivante, plus urbaine, mais toujours à taille humaine.\n\nVoyager au Cap-Vert reste relativement simple, y compris pour des profils variés comme les voyageurs solo, les familles ou les couples. Le pays est globalement sûr dans les zones adaptées, et les échanges sont facilités par une population accueillante. Le français est souvent compris, notamment parce qu\'il est enseigné à l\'école, ce qui permet de créer un lien assez naturel avec les habitants, même en dehors des circuits touristiques classiques.\n\nLe climat, quant à lui, est agréable une grande partie de l\'année, avec une période particulièrement favorable entre novembre et juin. Cette stabilité climatique permet d\'envisager un voyage à différentes périodes, en adaptant simplement le choix des îles en fonction des envies et du rythme souhaité.\n\nCe qui marque le plus au Cap-Vert, au-delà des paysages et des activités, c\'est cette sensation difficile à décrire d\'un voyage à la fois dépaysant et accessible. Une énergie douce, parfois comparée à celle du Brésil, se dégage de l\'archipel, entre musique, lumière et simplicité des échanges. On s\'y sent rapidement à sa place, sans effort.\n\nLe Cap-Vert s\'adresse ainsi à ceux qui recherchent une destination encore préservée, capable d\'offrir à la fois des expériences actives comme la randonnée, des moments de repos sur des plages peu fréquentées et une immersion culturelle naturelle, sans complexité logistique. C\'est aussi une destination idéale pour celles et ceux qui souhaitent voyager autrement, en prenant le temps de découvrir, d\'observer et de ressentir.\n\nPlus qu\'un simple voyage, le Cap-Vert est souvent une première rencontre avec une autre manière de parcourir le monde, plus lente, plus ancrée, et profondément authentique.', 'publie', '2026-04-03 09:33:17', 'cap-vert-destination-preservee-randonnees-plages-culture', NULL, 1, 1, NULL),
(10, 'Découvrir l\'Île Maurice autrement : une île authentique aux mille visages', 'Souvent associée aux voyages de noces et aux plages de sable fin bordées de lagons turquoise, l\'Île Maurice est pourtant bien plus qu\'une destination balnéaire. Derrière cette image de carte postale se cache une île profondément surprenante, riche d\'une diversité de paysages, de cultures et d\'expériences qui en font une destination à part entière, bien au-delà des clichés.\n\nSituée dans l\'océan Indien, l\'Île Maurice attire depuis longtemps les voyageurs en quête d\'évasion, et notamment les couples à la recherche d\'un cadre idyllique pour un voyage de noces. Mais réduire Maurice à ses hôtels et à ses plages serait passer à côté de l\'essentiel. Car l\'île révèle toute sa richesse dès que l\'on s\'éloigne du littoral.\n\nÀ l\'intérieur des terres, les paysages changent radicalement. Les reliefs volcaniques, les forêts luxuriantes et les parcs naturels offrent un tout autre visage de Maurice, plus sauvage et inattendu. Le parc national des Gorges de la Rivière Noire en est un parfait exemple : un territoire préservé où les sentiers de randonnée traversent une végétation dense, ponctuée de points de vue spectaculaires. Plus loin, les terres de Chamarel, avec leurs célèbres nuances colorées, rappellent l\'origine volcanique de l\'île et ajoutent à cette impression de diversité permanente.\n\nCette richesse naturelle s\'accompagne d\'une identité culturelle unique. L\'Île Maurice est un véritable carrefour entre l\'Afrique, l\'Inde, l\'Europe et la Chine. Ce mélange se retrouve partout : dans la langue, dans la cuisine, dans les traditions et dans le quotidien des Mauriciens. On passe d\'un temple hindou à une église, d\'un marché animé aux influences indiennes à une rue aux accents créoles, sans jamais quitter l\'île. Cette coexistence harmonieuse donne à Maurice une atmosphère singulière, à la fois douce, vivante et profondément humaine.\n\nCôté gastronomie, cette diversité culturelle se traduit par une richesse de saveurs qui font partie intégrante du voyage. Les influences indiennes, africaines et asiatiques se mêlent dans une cuisine parfumée, généreuse et accessible, que l\'on découvre aussi bien dans les marchés locaux que dans de petites adresses familiales.\n\nL\'Île Maurice séduit aussi par sa facilité de voyage. Les infrastructures sont développées, les distances restent courtes et l\'accueil est reconnu pour sa chaleur. Cela en fait une destination adaptée à différents profils de voyageurs, que ce soit pour un premier voyage lointain, un séjour en famille, une lune de miel ou un voyage en solo. Le français est largement parlé, ce qui facilite les échanges et renforce ce sentiment de confort dès l\'arrivée.\n\nMais ce qui marque le plus, au-delà de la beauté évidente de ses plages, c\'est cette capacité qu\'a l\'île à se révéler progressivement. En prenant le temps de s\'éloigner des hôtels, de traverser les villages, de s\'aventurer dans les terres ou de rencontrer les habitants, on découvre une autre Maurice, plus authentique, plus nuancée, presque inattendue.\n\nC\'est cette dualité qui fait toute la force de la destination. D\'un côté, une île accessible, rassurante et idéale pour se reposer. De l\'autre, un territoire riche, vivant, où chaque détour peut devenir une découverte. L\'Île Maurice ne se résume pas à une image figée de lagon et de sable blanc. Elle se vit, se parcourt et se comprend dans sa globalité.\n\nChoisir Maurice, c\'est donc faire le choix d\'une destination complète, capable d\'offrir à la fois des paysages paradisiaques, une immersion culturelle profonde et une véritable sensation de déconnexion. Une île aux mille visages, où chaque voyage peut être différent.', 'publie', '2026-04-03 09:40:42', 'decouvrir-ile-maurice-autrement-ile-authentique', NULL, 1, 2, NULL),
(11, 'Égypte : remonter le Nil, entre parfums d\'Orient, souks animés et rêves d\'enfance', 'Il y a des voyages que l\'on prépare. Et d\'autres que l\'on porte en soi depuis l\'enfance. L\'Égypte fait partie de ceux-là. Un pays qui évoque immédiatement des images presque irréelles, entre temples millénaires, désert infini et navigation lente sur le Nil. Mais une fois sur place, ce qui marque le plus n\'est pas seulement ce que l\'on voit. C\'est ce que l\'on ressent.\n\nLe Nil, justement, est souvent le fil conducteur de ce voyage. Le remonter, doucement, à bord d\'une felouque ou d\'une dahabiya, transforme l\'expérience. Le temps semble suspendu. Les rives défilent lentement, entre palmiers, villages et scènes de vie quotidienne. Il y a une odeur particulière dans l\'air, un mélange de végétation, de chaleur et d\'eau, presque enveloppant, qui accompagne chaque instant et donne au voyage une dimension sensorielle unique.\n\nAu fil de cette remontée, les paysages deviennent presque hypnotiques. La lumière change constamment, révélant des nuances ocre et dorées qui semblent appartenir à un autre temps. Le désert n\'est jamais loin, et pourtant la vie s\'organise autour du fleuve avec une simplicité désarmante. Cette dualité entre aridité et fertilité donne au Nil une place centrale, presque sacrée, dans l\'expérience du voyage.\n\nPuis viennent les découvertes historiques, souvent attendues, mais rarement vécues comme on les imagine. Les temples de Karnak, de Louxor ou encore Abou Simbel ne sont pas seulement impressionnants par leur taille. Ils dégagent une présence, une énergie difficile à expliquer. On ne les visite pas comme des monuments. On les traverse, presque en silence, avec la sensation d\'entrer dans un récit qui nous dépasse.\n\nEntre deux escales, les villes offrent un tout autre rythme. Les souks, notamment, plongent immédiatement dans une ambiance vibrante, où les couleurs, les odeurs et les sons se mêlent. Les étals d\'épices, les tissus, les objets artisanaux et les voix qui s\'entrecroisent créent une énergie presque désorientante au premier regard, mais profondément vivante. On s\'y perd, on observe, on échange, et c\'est souvent là que se jouent les moments les plus spontanés du voyage.\n\nL\'Égypte ne se découvre pas uniquement à travers ses sites emblématiques. Elle se vit dans les détails, dans les contrastes, dans cette capacité à passer d\'un silence presque sacré face à un temple à l\'agitation d\'un marché en quelques heures seulement. C\'est un pays qui sollicite tous les sens et qui laisse rarement indifférent.\n\nCe qui surprend souvent, c\'est cette impression persistante de familiarité. Comme si l\'on reconnaissait des paysages, des symboles, des histoires déjà vues, déjà rêvées. L\'Égypte a cette capacité rare de donner corps à un imaginaire collectif, celui des livres d\'enfance, des récits anciens, des mystères fascinants.\n\nVoyager en Égypte, c\'est ainsi accepter de se laisser porter. De ralentir sur le Nil, de s\'imprégner des lieux, de ressentir plus que de comprendre. C\'est un voyage qui marque, non seulement par la richesse de son patrimoine, mais par l\'émotion qu\'il suscite.\n\nPlus qu\'une destination, l\'Égypte reste une expérience à part. Un voyage qui, souvent, ne ressemble à aucun autre.', 'publie', '2026-04-03 09:42:30', 'egypte-remonter-le-nil-parfums-orient-souks', NULL, 1, 3, NULL),
(12, 'Le luxe discret à l\'île Maurice : une autre manière de vivre son voyage de noces', 'Il existe une image bien connue du voyage de noces à l\'île Maurice : des hôtels en bord de mer, un service attentionné, un cadre parfaitement orchestré. Et puis, il y a une autre manière de vivre ce moment, plus silencieuse, plus intime, presque invisible. De plus en plus de couples ne recherchent plus seulement un lieu où séjourner, mais une expérience à ressentir pleinement, un espace où ralentir, se retrouver, et simplement être ensemble.\n\nLe luxe discret s\'exprime ici autrement. Il se glisse dans un réveil sans bruit, dans la lumière douce qui entre dans une maison ouverte sur la nature, dans un café partagé sans contrainte d\'horaire. Il se trouve dans ces lieux à l\'écart, villas ou refuges intégrés dans leur environnement, où l\'on ne se sent pas accueilli comme un client, mais installé comme chez soi, ailleurs. À Maurice, cette approche du voyage séduit de plus en plus : moins de mise en scène, moins de déplacements, mais davantage de présence, de simplicité et de connexion à l\'essentiel.\n\nCe choix reflète aussi une envie de voyager autrement, de manière plus consciente, en privilégiant des lieux respectueux de leur environnement et des expériences plus authentiques. Un voyage de noces devient alors bien plus qu\'un séjour : c\'est une parenthèse où le temps ralentit, où chaque moment prend de la valeur, où l\'on commence à écrire une histoire à deux, loin du rythme imposé.\n\nEt peut-être que le vrai luxe, aujourd\'hui, à l\'île Maurice, n\'est plus dans ce que l\'on montre, mais dans ce que l\'on ressent profondément. Une sensation d\'espace, de calme, de justesse. Une manière douce et sincère de commencer un nouveau chapitre.', 'publie', '2026-04-03 16:07:55', 'luxe-discret-ile-maurice-voyage-de-noces', NULL, 1, 2, NULL),
(13, 'Pourquoi certaines destinations deviennent soudain incontournables… et ce que cela dit vraiment de notre manière de voyager', 'Chaque année, certaines destinations semblent apparaître presque soudainement sur le devant de la scène. Elles s\'imposent dans les recherches, circulent sur les réseaux, s\'invitent dans les conversations. La Namibie, le Sri Lanka, le Japon ou encore Madagascar font partie de ces pays qui attirent aujourd\'hui de plus en plus de voyageurs. Pourtant, ces engouements ne sont jamais le fruit du hasard. Ils racontent quelque chose de plus profond : une évolution dans la manière de voyager.\n\nDerrière ces tendances, plusieurs dynamiques se croisent. L\'ouverture de nouvelles liaisons aériennes rend certaines régions plus accessibles. Une mise en lumière médiatique ou culturelle peut soudain révéler une destination jusqu\'alors discrète. Le contexte géopolitique joue également un rôle, en redirigeant les flux vers des pays perçus comme plus stables. Mais au-delà de ces facteurs visibles, un mouvement plus silencieux s\'opère depuis quelques années.\n\nLes voyageurs ne cherchent plus uniquement à \"voir\" une destination. Ils veulent la ressentir, la comprendre, s\'y immerger. Cette quête transforme naturellement les choix. Les paysages trop fréquentés laissent place à des territoires plus vastes, plus bruts, où la nature reprend sa place. Les expériences standardisées cèdent peu à peu à des voyages plus ancrés, plus humains, où les rencontres et les rythmes locaux comptent autant que les sites visités.\n\nLa Namibie, par exemple, fascine par ses grands espaces et ses contrastes presque irréels. Le Sri Lanka séduit par son équilibre entre culture, nature et douceur de vivre. Le Japon attire par la finesse de son esthétique et la profondeur de ses traditions. Madagascar intrigue par son caractère encore préservé et sa biodiversité unique. Ces destinations ont en commun de proposer autre chose qu\'un simple décor : elles offrent une expérience.\n\nMais cette attractivité nouvelle pose aussi une question essentielle. À partir de quand une destination \"tendance\" cesse-t-elle d\'être authentique ? Et comment voyager dans ces lieux sans reproduire les mécanismes du tourisme de masse que l\'on cherche justement à éviter ?\n\nLa réponse ne se trouve pas uniquement dans le choix de la destination, mais dans la manière de la découvrir. Prendre le temps, sortir des itinéraires classiques, privilégier des acteurs locaux, accepter un certain décalage… ce sont souvent ces éléments qui permettent de vivre une expérience différente, même dans un pays devenu populaire.\n\nCar au fond, une destination ne devient pas incontournable uniquement parce qu\'elle est mise en lumière. Elle le devient parce qu\'elle répond à une aspiration collective, à un moment donné. Aujourd\'hui, cette aspiration semble claire : voyager autrement, avec plus de sens, plus de conscience, plus de lien.\n\nEt dans ce contexte, le véritable luxe n\'est peut-être plus de découvrir un endroit avant tout le monde. C\'est de réussir à le vivre pleinement, au-delà des tendances.', 'publie', '2026-04-03 16:14:24', 'destinations-incontournables-maniere-de-voyager', NULL, 1, NULL, NULL),
(14, 'Et si voyager, c\'était ralentir : retrouver le temps, le silence et une autre manière de découvrir le monde', 'Et si le véritable luxe n\'était plus d\'en faire toujours plus, mais simplement de ralentir ? Cette question, de plus en plus de voyageurs se la posent, souvent sans même s\'en rendre compte. Car dans un quotidien rythmé par l\'urgence, les écrans et les sollicitations permanentes, le voyage n\'échappe plus à cette accélération. On enchaîne les étapes, on multiplie les lieux, on coche des expériences, parfois au détriment de l\'essentiel.\n\nPeu à peu, une autre manière de voyager s\'impose. Plus douce, plus consciente, presque instinctive. Elle ne repose pas sur la quantité de lieux visités, mais sur la qualité des moments vécus. Ralentir ne signifie pas renoncer à découvrir, mais accepter de vivre pleinement chaque endroit, sans chercher à aller plus vite que le temps lui-même.\n\nCela commence souvent par un changement de rythme. Rester plus longtemps au même endroit, marcher plutôt que courir, observer plutôt que consommer. S\'asseoir face à un paysage sans objectif précis, regarder la lumière évoluer, écouter les sons environnants, ressentir simplement l\'atmosphère d\'un lieu. Ces instants, en apparence anodins, deviennent souvent les souvenirs les plus marquants.\n\nCertaines destinations se prêtent particulièrement à cette approche. Un écolodge niché au cœur d\'une forêt tropicale, où les journées sont rythmées par la nature. Une plage encore préservée, où le temps semble suspendu entre deux marées. Un ryokan au Japon, où chaque geste invite au calme et à la simplicité. Ou encore une nuit dans le désert, sous un ciel étoilé, où le silence devient presque palpable. Ces lieux ont en commun de créer un espace différent, loin du bruit, propice à une véritable déconnexion.\n\nMais ralentir, ce n\'est pas seulement une question de décor. C\'est une posture. Une manière d\'aborder le voyage avec plus de présence, plus d\'attention. Accepter de ne pas tout voir, de ne pas tout faire, pour mieux ressentir ce qui est là. C\'est souvent dans ces moments que le voyage prend une dimension plus profonde, presque intime.\n\nAujourd\'hui, cette recherche de lenteur s\'inscrit dans une évolution plus large des attentes des voyageurs. Le besoin de nature, de silence, de reconnexion devient central. Voyager ne consiste plus uniquement à découvrir un pays, mais à s\'offrir une parenthèse, un espace où l\'on respire différemment, où l\'on retrouve une forme de clarté.\n\nEt si, finalement, le plus beau des voyages n\'était pas celui qui nous emmène le plus loin, mais celui qui nous permet de nous retrouver, simplement, au bon rythme ?\n\nUn matin sans réveil.\nUne journée sans notifications.\n\nEt si le vrai voyage commençait là ?\n\nDans cette capacité à se déconnecter du monde…\npour mieux se reconnecter à l\'essentiel.\n\nChez Amanéa, ce sont souvent ces moments-là que l\'on cherche à créer.\nDes voyages où l\'on ne remplit pas chaque instant, mais où l\'on laisse de la place à ce qui compte vraiment.', 'publie', '2026-04-03 16:18:46', 'voyager-ralentir-temps-silence-decouvrir-monde', NULL, 1, NULL, NULL),
(15, 'Peut-on vraiment organiser un voyage avec l\'IA ?', 'Depuis quelques mois, beaucoup de voyageurs testent l\'intelligence artificielle pour organiser leurs voyages. En quelques secondes, un outil peut générer un itinéraire complet : villes à visiter, durée des étapes, activités à ne pas manquer.\n\nSur le papier, tout semble parfait.\n\nMais un voyage ne se construit pas uniquement à partir d\'informations. Il se construit avec du rythme, des distances réelles, des saisons, des rencontres, et parfois avec des détours que seuls ceux qui connaissent un territoire peuvent suggérer.\n\nLes intelligences artificielles savent agréger des données. Elles peuvent inspirer, donner des idées, ouvrir des pistes. Mais elles ne savent pas toujours ce que devient un lieu après quelques années de tourisme intense, quels hébergements ont une âme particulière, ou quel guide passionné peut transformer une simple visite en véritable rencontre.\n\nUn voyage est une expérience vivante. Il se façonne avec des échanges, avec une connaissance du terrain et avec une attention portée aux détails qui font toute la différence une fois sur place.\n\nL\'IA peut être un point de départ.\n\nMais un voyage vraiment réussi naît souvent ailleurs : dans la conversation, dans l\'écoute, et dans l\'envie de créer une expérience qui ressemble vraiment à ceux qui vont la vivre.\n\nChez Amanéa, c\'est souvent ainsi que commencent les plus beaux voyages.', 'publie', '2026-04-03 16:25:44', 'peut-on-organiser-voyage-avec-ia', NULL, 1, NULL, NULL),
(16, 'Réserver son voyage en ligne : entre doutes et derniers ajustements', 'Tout semble simple aujourd\'hui.\n\nQuelques onglets ouverts, des comparateurs, des avis, des cartes interactives… et en quelques heures, un voyage prend forme. Les vols sont réservés, les hébergements choisis, les étapes dessinées.\n\nSur le papier, tout est prêt.\n\nD\'ailleurs, 66 % des voyageurs réservent désormais leur voyage en ligne. Tout semble rapide, fluide, accessible.\n\nEt pourtant, c\'est souvent à ce moment-là que le doute s\'installe.\n\nEst-ce que les distances sont réalistes ? Est-ce que l\'enchaînement tient vraiment ? Est-ce que cet hôtel correspond à l\'expérience que j\'imagine… ou seulement à une bonne note en ligne ?\n\nRécemment, une cliente m\'a contactée après avoir tout organisé seule. Elle n\'attendait pas une refonte complète. Juste un regard.\n\nEn reprenant son itinéraire, on n\'a presque rien changé. Mais on a déplacé une étape trop ambitieuse, allégé une journée, ajusté un transfert qui aurait cassé le rythme du voyage. Et surtout, on a réaligné l\'ensemble avec ce qu\'elle voulait vraiment vivre.\n\nC\'est là que se joue quelque chose de très actuel.\n\nAujourd\'hui, réserver en ligne est devenu un réflexe. Les outils sont puissants, accessibles, rassurants en apparence. Mais ils restent des outils.\n\nIls permettent d\'assembler. Pas toujours de composer.\n\nCar un voyage ne se résume pas à une suite de réservations. C\'est un équilibre subtil entre logistique, rythme, intentions… et émotions.\n\nEt c\'est précisément à l\'étape des derniers ajustements que l\'humain reprend sa place.\n\nNon pas pour faire à la place. Mais pour sécuriser, affiner, donner du sens.\n\nChez Amanéa, c\'est souvent là que tout commence.\n\nQuand le voyage existe déjà… mais qu\'il ne s\'est pas encore vraiment dessiné.\n\nEt parfois, tout se joue dans ces derniers détails que l\'on ne voit pas… mais que l\'on ressent.', 'publie', '2026-04-03 16:28:08', 'reserver-voyage-en-ligne-doutes-ajustements', NULL, 1, NULL, NULL),
(17, 'Voyager autrement : le retour du collectif', 'Il y a quelques années, voyager, c\'était cocher des cases.\n\nEnchaîner les lieux, optimiser les journées, rentrer avec le sentiment d\'avoir \"tout vu\".\n\nAujourd\'hui, j\'observe autre chose. Des voyageurs qui ralentissent. Qui choisissent de rester plus longtemps au même endroit. Qui préfèrent comprendre plutôt que simplement regarder.\n\nUne cliente m\'a dit récemment : \"Je ne veux plus faire un voyage, je veux vivre quelque chose.\"\n\nAlors on a revu son itinéraire. Supprimé la moitié des étapes. Gardé trois lieux. Et surtout, laissé de l\'espace.\n\nLe slow travel, ce n\'est pas faire moins. C\'est ressentir plus.\n\nMais ce qui évolue aussi, plus discrètement, c\'est notre façon de partir seul.\n\nCar derrière l\'envie d\'indépendance, il y a parfois un autre besoin. Celui de ne pas tout vivre en solitaire.\n\nDe plus en plus de voyageurs choisissent aujourd\'hui de rejoindre un groupe. Pas un groupe imposé, ni un circuit impersonnel. Mais un cercle à taille humaine, où l\'on partage un même état d\'esprit, une même curiosité du monde.\n\nVoyager seul, c\'est se retrouver. Voyager à plusieurs, c\'est aussi se découvrir autrement.\n\nDans ces voyages, quelque chose se passe. Les échanges sont plus spontanés, les liens plus rapides, presque évidents. On partage une table, un paysage, un moment simple… et cela suffit à créer une connexion.\n\nLes voyages entre femmes, notamment, ouvrent un espace encore différent. Plus libre, plus doux parfois. Un espace où l\'on se sent à sa place, sans avoir à jouer un rôle. Où les rencontres prennent une autre dimension.\n\nEt souvent, ce sont ces liens que l\'on emporte avec soi.\n\nBien après les paysages.\n\nCes formats restent encore discrets. Et pourtant, ce sont souvent ceux qui transforment le plus profondément une manière de voyager.\n\nParce qu\'au fond, voyager autrement, ce n\'est pas seulement changer de rythme.\n\nC\'est aussi changer de regard.', 'publie', '2026-04-03 16:30:55', 'voyager-autrement-retour-du-collectif', NULL, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `BELONGS_TO`
--

CREATE TABLE `BELONGS_TO` (
  `Id_CATEGORY` int(11) NOT NULL,
  `Id_ARTICLE` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `BELONGS_TO`
--

INSERT INTO `BELONGS_TO` (`Id_CATEGORY`, `Id_ARTICLE`) VALUES
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(2, 6),
(2, 15),
(2, 16),
(3, 4),
(4, 5),
(4, 13),
(4, 14),
(4, 17),
(6, 7),
(6, 8);

-- --------------------------------------------------------

--
-- Structure de la table `CATEGORY`
--

CREATE TABLE `CATEGORY` (
  `Id_CATEGORY` int(11) NOT NULL,
  `name` enum('destination','conseils','actualites','experiences','coup de coeur','inspirations') DEFAULT NULL,
  `slug` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `CATEGORY`
--

INSERT INTO `CATEGORY` (`Id_CATEGORY`, `name`, `slug`) VALUES
(1, 'destination', 'destination'),
(2, 'conseils', 'conseils'),
(3, 'actualites', 'actualites'),
(4, 'inspirations', 'inspirations'),
(5, 'experiences', 'experiences'),
(6, 'coup de coeur', 'coup-de-coeur');

-- --------------------------------------------------------

--
-- Structure de la table `CONTAINS_CONTENTS`
--

CREATE TABLE `CONTAINS_CONTENTS` (
  `Id_ARTICLE` int(11) NOT NULL,
  `Id_MEDIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `DESTINATION`
--

CREATE TABLE `DESTINATION` (
  `Id_DESTINATION` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `pexels_keyword` varchar(100) DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `DESTINATION`
--

INSERT INTO `DESTINATION` (`Id_DESTINATION`, `name`, `country`, `description`, `pexels_keyword`, `slug`) VALUES
(1, 'Cap-Vert', 'Cap-Vert', 'Archipel préservé au large de l\'Afrique de l\'Ouest, entre plages et volcans.', 'cape verde travel island', 'cap-vert'),
(2, 'Île Maurice', 'Île Maurice', 'Île tropicale de l\'océan Indien, entre lagon turquoise et culture créole.', 'mauritius island tropical lagoon', 'ile-maurice'),
(3, 'Égypte', 'Égypte', 'Terre des pharaons, entre désert, Nil et trésors antiques.', 'egypt pyramids nile desert', 'egypte'),
(4, 'Sri Lanka', 'Sri Lanka', 'Île aux mille visages entre temples bouddhistes, forêts et plages dorées.', 'sri lanka temple nature beach', 'sri-lanka'),
(5, 'Japon', 'Japon', 'Entre tradition et modernité, une destination unique aux paysages contrastés.', 'japan temple nature travel', 'japon'),
(6, 'Madagascar', 'Madagascar', 'La grande île, sanctuaire de biodiversité unique au monde.', 'madagascar nature wildlife', 'madagascar'),
(7, 'Laponie', 'Laponie', 'Terres arctiques magiques entre aurores boréales, rennes et nature immaculée.', 'lapland aurora borealis snow', 'laponie');

-- --------------------------------------------------------

--
-- Structure de la table `DOCUMENT`
--

CREATE TABLE `DOCUMENT` (
  `Id_DOCUMENT` int(11) NOT NULL,
  `type` enum('devis','facture','autre') DEFAULT NULL,
  `pdf_file` varchar(255) DEFAULT NULL,
  `status` enum('en_attente','valide','refuse') DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `Id_TRAVEL_PROJECT` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `MEDIA`
--

CREATE TABLE `MEDIA` (
  `Id_MEDIA` int(11) NOT NULL,
  `file_name` varchar(255) DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `copyright` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `MEDIA`
--

INSERT INTO `MEDIA` (`Id_MEDIA`, `file_name`, `upload_date`, `caption`, `copyright`) VALUES
(1, 'groupe.webp', '2026-03-31 22:15:34', 'Voyage en groupe', 'Amanéa Voyage'),
(2, 'feminin.webp', '2026-03-31 22:15:34', 'Voyage au féminin', 'Amanéa Voyage'),
(3, 'noces.webp', '2026-03-31 22:15:34', 'Voyage de noces', 'Amanéa Voyage'),
(4, 'personnalise.webp', '2026-03-31 22:15:34', 'Voyage personnalisé', 'Amanéa Voyage');

-- --------------------------------------------------------

--
-- Structure de la table `MESSAGE`
--

CREATE TABLE `MESSAGE` (
  `Id_MESSAGE` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `status` enum('non_lu','lu','repondu') DEFAULT NULL,
  `sent_date` datetime DEFAULT NULL,
  `Id_ADMIN` int(11) DEFAULT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `travel_type` varchar(100) DEFAULT NULL,
  `destination` varchar(100) DEFAULT NULL,
  `duration` varchar(50) DEFAULT NULL,
  `budget` varchar(50) DEFAULT NULL,
  `travelers` int(11) DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `project` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `NOTEBOOK`
--

CREATE TABLE `NOTEBOOK` (
  `Id_NOTEBOOK` int(11) NOT NULL,
  `pdf_file` text DEFAULT NULL,
  `upload_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `NOTIFICATION`
--

CREATE TABLE `NOTIFICATION` (
  `Id_NOTIFICATION` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `Id_USER` int(11) NOT NULL,
  `Id_ADMIN` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TRAVEL_PROJECT`
--

CREATE TABLE `TRAVEL_PROJECT` (
  `Id_TRAVEL_PROJECT` int(11) NOT NULL,
  `title` varchar(150) DEFAULT NULL,
  `destination` varchar(255) DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `budget` decimal(10,2) DEFAULT NULL,
  `status` enum('en_attente','en_cours','confirme','termine') DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `Id_NOTEBOOK` int(11) NOT NULL,
  `Id_USER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `TYPE`
--

CREATE TABLE `TYPE` (
  `Id_TYPE` int(11) NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(50) DEFAULT NULL,
  `Id_MEDIA` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `TYPE`
--

INSERT INTO `TYPE` (`Id_TYPE`, `title`, `description`, `slug`, `Id_MEDIA`) VALUES
(1, 'Voyage en groupe', 'Partez en groupe et partagez des moments inoubliables.', 'voyage-en-groupe', 1),
(2, 'Voyage au féminin', 'Des voyages pensés pour et par les femmes.', 'voyage-au-feminin', 2),
(3, 'Voyage de noces', 'Un voyage romantique pour célébrer votre amour.', 'voyage-de-noces', 3),
(4, 'Voyage personnalisé', 'Un voyage 100% sur-mesure selon vos envies.', 'voyage-personnalise', 4);

-- --------------------------------------------------------

--
-- Structure de la table `USER`
--

CREATE TABLE `USER` (
  `Id_USER` int(11) NOT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `registration_date` datetime DEFAULT NULL,
  `password_changed` tinyint(1) NOT NULL DEFAULT 0,
  `terms_accepted` tinyint(1) NOT NULL DEFAULT 0,
  `terms_accepted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `USER`
--

INSERT INTO `USER` (`Id_USER`, `last_name`, `first_name`, `email`, `password`, `phone`, `registration_date`, `password_changed`, `terms_accepted`, `terms_accepted_date`) VALUES
(1, 'Dupont', 'Marie', 'marie@test.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uSh95TUR2', '0612345678', '2026-03-31 22:26:46', 1, 1, NULL);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ADMIN`
--
ALTER TABLE `ADMIN`
  ADD PRIMARY KEY (`Id_ADMIN`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Index pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD PRIMARY KEY (`Id_ARTICLE`),
  ADD KEY `Id_MEDIA` (`Id_MEDIA`),
  ADD KEY `Id_ADMIN` (`Id_ADMIN`),
  ADD KEY `Id_DESTINATION` (`Id_DESTINATION`);

--
-- Index pour la table `BELONGS_TO`
--
ALTER TABLE `BELONGS_TO`
  ADD PRIMARY KEY (`Id_CATEGORY`,`Id_ARTICLE`),
  ADD KEY `Id_ARTICLE` (`Id_ARTICLE`);

--
-- Index pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  ADD PRIMARY KEY (`Id_CATEGORY`);

--
-- Index pour la table `CONTAINS_CONTENTS`
--
ALTER TABLE `CONTAINS_CONTENTS`
  ADD PRIMARY KEY (`Id_ARTICLE`,`Id_MEDIA`),
  ADD KEY `Id_MEDIA` (`Id_MEDIA`);

--
-- Index pour la table `DESTINATION`
--
ALTER TABLE `DESTINATION`
  ADD PRIMARY KEY (`Id_DESTINATION`);

--
-- Index pour la table `DOCUMENT`
--
ALTER TABLE `DOCUMENT`
  ADD PRIMARY KEY (`Id_DOCUMENT`),
  ADD KEY `Id_TRAVEL_PROJECT` (`Id_TRAVEL_PROJECT`);

--
-- Index pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  ADD PRIMARY KEY (`Id_MEDIA`);

--
-- Index pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD PRIMARY KEY (`Id_MESSAGE`),
  ADD KEY `Id_ADMIN` (`Id_ADMIN`);

--
-- Index pour la table `NOTEBOOK`
--
ALTER TABLE `NOTEBOOK`
  ADD PRIMARY KEY (`Id_NOTEBOOK`);

--
-- Index pour la table `NOTIFICATION`
--
ALTER TABLE `NOTIFICATION`
  ADD PRIMARY KEY (`Id_NOTIFICATION`),
  ADD KEY `Id_USER` (`Id_USER`),
  ADD KEY `Id_ADMIN` (`Id_ADMIN`);

--
-- Index pour la table `TRAVEL_PROJECT`
--
ALTER TABLE `TRAVEL_PROJECT`
  ADD PRIMARY KEY (`Id_TRAVEL_PROJECT`),
  ADD UNIQUE KEY `Id_NOTEBOOK` (`Id_NOTEBOOK`),
  ADD KEY `Id_USER` (`Id_USER`);

--
-- Index pour la table `TYPE`
--
ALTER TABLE `TYPE`
  ADD PRIMARY KEY (`Id_TYPE`),
  ADD UNIQUE KEY `Id_MEDIA` (`Id_MEDIA`);

--
-- Index pour la table `USER`
--
ALTER TABLE `USER`
  ADD PRIMARY KEY (`Id_USER`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ADMIN`
--
ALTER TABLE `ADMIN`
  MODIFY `Id_ADMIN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  MODIFY `Id_ARTICLE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `CATEGORY`
--
ALTER TABLE `CATEGORY`
  MODIFY `Id_CATEGORY` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `DESTINATION`
--
ALTER TABLE `DESTINATION`
  MODIFY `Id_DESTINATION` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `DOCUMENT`
--
ALTER TABLE `DOCUMENT`
  MODIFY `Id_DOCUMENT` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `MEDIA`
--
ALTER TABLE `MEDIA`
  MODIFY `Id_MEDIA` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  MODIFY `Id_MESSAGE` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `NOTEBOOK`
--
ALTER TABLE `NOTEBOOK`
  MODIFY `Id_NOTEBOOK` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `NOTIFICATION`
--
ALTER TABLE `NOTIFICATION`
  MODIFY `Id_NOTIFICATION` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `TRAVEL_PROJECT`
--
ALTER TABLE `TRAVEL_PROJECT`
  MODIFY `Id_TRAVEL_PROJECT` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `TYPE`
--
ALTER TABLE `TYPE`
  MODIFY `Id_TYPE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `USER`
--
ALTER TABLE `USER`
  MODIFY `Id_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ARTICLE`
--
ALTER TABLE `ARTICLE`
  ADD CONSTRAINT `ARTICLE_ibfk_1` FOREIGN KEY (`Id_MEDIA`) REFERENCES `MEDIA` (`Id_MEDIA`),
  ADD CONSTRAINT `ARTICLE_ibfk_2` FOREIGN KEY (`Id_ADMIN`) REFERENCES `ADMIN` (`Id_ADMIN`),
  ADD CONSTRAINT `ARTICLE_ibfk_3` FOREIGN KEY (`Id_DESTINATION`) REFERENCES `DESTINATION` (`Id_DESTINATION`);

--
-- Contraintes pour la table `BELONGS_TO`
--
ALTER TABLE `BELONGS_TO`
  ADD CONSTRAINT `BELONGS_TO_ibfk_1` FOREIGN KEY (`Id_CATEGORY`) REFERENCES `CATEGORY` (`Id_CATEGORY`),
  ADD CONSTRAINT `BELONGS_TO_ibfk_2` FOREIGN KEY (`Id_ARTICLE`) REFERENCES `ARTICLE` (`Id_ARTICLE`);

--
-- Contraintes pour la table `CONTAINS_CONTENTS`
--
ALTER TABLE `CONTAINS_CONTENTS`
  ADD CONSTRAINT `CONTAINS_CONTENTS_ibfk_1` FOREIGN KEY (`Id_ARTICLE`) REFERENCES `ARTICLE` (`Id_ARTICLE`),
  ADD CONSTRAINT `CONTAINS_CONTENTS_ibfk_2` FOREIGN KEY (`Id_MEDIA`) REFERENCES `MEDIA` (`Id_MEDIA`);

--
-- Contraintes pour la table `DOCUMENT`
--
ALTER TABLE `DOCUMENT`
  ADD CONSTRAINT `DOCUMENT_ibfk_1` FOREIGN KEY (`Id_TRAVEL_PROJECT`) REFERENCES `TRAVEL_PROJECT` (`Id_TRAVEL_PROJECT`);

--
-- Contraintes pour la table `MESSAGE`
--
ALTER TABLE `MESSAGE`
  ADD CONSTRAINT `MESSAGE_ibfk_1` FOREIGN KEY (`Id_ADMIN`) REFERENCES `ADMIN` (`Id_ADMIN`);

--
-- Contraintes pour la table `NOTIFICATION`
--
ALTER TABLE `NOTIFICATION`
  ADD CONSTRAINT `NOTIFICATION_ibfk_1` FOREIGN KEY (`Id_USER`) REFERENCES `USER` (`Id_USER`),
  ADD CONSTRAINT `NOTIFICATION_ibfk_2` FOREIGN KEY (`Id_ADMIN`) REFERENCES `ADMIN` (`Id_ADMIN`);

--
-- Contraintes pour la table `TRAVEL_PROJECT`
--
ALTER TABLE `TRAVEL_PROJECT`
  ADD CONSTRAINT `TRAVEL_PROJECT_ibfk_1` FOREIGN KEY (`Id_NOTEBOOK`) REFERENCES `NOTEBOOK` (`Id_NOTEBOOK`),
  ADD CONSTRAINT `TRAVEL_PROJECT_ibfk_2` FOREIGN KEY (`Id_USER`) REFERENCES `USER` (`Id_USER`);

--
-- Contraintes pour la table `TYPE`
--
ALTER TABLE `TYPE`
  ADD CONSTRAINT `TYPE_ibfk_1` FOREIGN KEY (`Id_MEDIA`) REFERENCES `MEDIA` (`Id_MEDIA`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
