<?php

/**
 * Programmatic SEO landing pages — one entry = one high-intent search query,
 * all powered by the same compressor. Each page has unique copy (intro, steps,
 * FAQ) so it stays useful and avoids thin/doorway content.
 *
 * Fields: title, description, h1, subtitle, intro (HTML), how (steps),
 *         faq (Q/A — also emitted as FAQPage JSON-LD), related (optional slugs).
 */

return [

    'compresser-jpg' => [
        'title'       => 'Compresser JPG en ligne gratuitement — Réduire la taille JPG',
        'description' => 'Compressez vos fichiers JPG gratuitement et en ligne. Réduisez le poids de vos photos JPG jusqu\'à 70 % sans perte de qualité visible.',
        'h1'          => 'Compresser un JPG en ligne, gratuitement',
        'subtitle'    => 'Réduisez le poids de vos fichiers JPG en quelques secondes, sans logiciel à installer.',
        'intro'       => '<p>Le JPG (ou JPEG) est le format photo le plus répandu sur le web. C\'est aussi celui qui prend le plus de place quand il n\'est pas optimisé : une photo de smartphone pèse facilement 4 à 8 Mo. Notre compresseur réduit ce poids tout en gardant une qualité visuelle quasi identique.</p>
                          <p>Tout se passe en ligne et sans inscription : vous déposez vos JPG, vous choisissez le niveau de compression, vous téléchargez. Vos fichiers ne sont jamais conservés.</p>',
        'how'         => [
            ['Déposez vos JPG', 'Glissez un ou plusieurs fichiers JPG dans la zone ci-dessus.'],
            ['Choisissez le niveau', 'Léger pour garder le maximum de détails, Fort pour le poids minimal.'],
            ['Téléchargez', 'Récupérez vos JPG compressés, prêts à être envoyés ou publiés.'],
        ],
        'faq'         => [
            ['Quelle est la différence entre JPG et JPEG ?', 'Aucune : ce sont deux noms du même format. « .jpg » est simplement l\'extension raccourcie de « .jpeg », un héritage des anciens systèmes limités à trois lettres.'],
            ['La compression JPG dégrade-t-elle la photo ?', 'Le JPG est un format « avec perte », mais aux niveaux Léger et Recommandé la différence est invisible à l\'œil nu. Vous pouvez comparer avant/après avant de télécharger.'],
            ['Puis-je compresser plusieurs JPG d\'un coup ?', 'Oui, déposez plusieurs fichiers et téléchargez-les ensemble. Le mode gratuit traite jusqu\'à plusieurs images par lot.'],
        ],
    ],

    'compresser-une-image' => [
        'title'       => 'Compresser une image en ligne gratuitement — PNG, JPG, WebP',
        'description' => 'Compressez une image gratuitement en ligne. Réduisez la taille de vos photos PNG, JPG et WebP sans perte de qualité visible, sans inscription.',
        'h1'          => 'Compresser une image en ligne, gratuitement',
        'subtitle'    => 'PNG, JPG ou WebP : réduisez le poids de votre image en un clic, directement dans le navigateur.',
        'intro'       => '<p>Une image trop lourde ralentit un site, sature une boîte mail ou dépasse les limites d\'un formulaire en ligne. La compresser permet de réduire son poids (en Ko ou Mo) sans changer ce qu\'on voit à l\'écran.</p>
                          <p>Notre outil prend en charge les trois formats les plus courants — PNG, JPG et WebP — et applique automatiquement la meilleure méthode de compression pour chacun.</p>',
        'how'         => [
            ['Importez votre image', 'Glissez-déposez votre fichier ou cliquez pour le sélectionner.'],
            ['Réglez la compression', 'Trois niveaux suffisent : Léger, Recommandé ou Fort.'],
            ['Récupérez le fichier', 'Téléchargez votre image allégée, prête à l\'emploi.'],
        ],
        'faq'         => [
            ['Quels formats d\'image sont acceptés ?', 'PNG, JPG/JPEG et WebP. Pour chaque format, l\'outil applique l\'algorithme le plus efficace (quantification de palette pour le PNG, ré-encodage pour le JPG et le WebP).'],
            ['Mes images sont-elles envoyées sur un serveur ?', 'Vos fichiers sont traités le temps de la compression puis supprimés automatiquement. Ils ne sont ni conservés, ni partagés.'],
            ['Combien d\'images puis-je compresser ?', 'Le mode gratuit est suffisant pour un usage quotidien. Le mode Pro débloque les gros fichiers et la méga-compression.'],
        ],
    ],

    'compresser-image-en-ligne' => [
        'title'       => 'Compresser une image en ligne — Outil gratuit sans inscription',
        'description' => 'Outil en ligne pour compresser vos images gratuitement, sans logiciel ni inscription. PNG, JPG, WebP. Tout se passe dans votre navigateur.',
        'h1'          => 'Compresser une image en ligne',
        'subtitle'    => 'Aucun logiciel, aucune inscription : déposez votre image et téléchargez-la compressée.',
        'intro'       => '<p>Pas besoin d\'installer Photoshop ou un utilitaire de bureau pour alléger une image. Un outil en ligne fait le travail en quelques secondes, depuis n\'importe quel appareil — ordinateur, tablette ou téléphone.</p>
                          <p>L\'avantage du « en ligne », c\'est la rapidité : vous déposez, l\'outil compresse, vous récupérez le fichier. Et comme tout est gratuit et sans compte, vous pouvez l\'utiliser autant de fois que nécessaire.</p>',
        'how'         => [
            ['Ouvrez l\'outil', 'Rien à télécharger : la page est prête à recevoir vos images.'],
            ['Déposez votre image', 'Depuis votre ordinateur ou votre mobile.'],
            ['Téléchargez', 'Votre image compressée est disponible immédiatement.'],
        ],
        'faq'         => [
            ['L\'outil fonctionne-t-il sur mobile ?', 'Oui. La page est responsive et vous pouvez compresser une photo directement depuis votre smartphone, sans application à installer.'],
            ['Faut-il créer un compte ?', 'Non, la compression est accessible sans inscription. Un compte gratuit permet seulement de retrouver l\'historique de vos compressions.'],
            ['Y a-t-il une limite de taille ?', 'Jusqu\'à 10 Mo par image en gratuit, et 50 Mo en Pro.'],
        ],
    ],

    'compresser-photo' => [
        'title'       => 'Compresser une photo en ligne gratuitement — Réduire le poids',
        'description' => 'Compressez vos photos gratuitement en ligne. Réduisez le poids de vos photos JPG, PNG et WebP sans perte de qualité visible, sans inscription.',
        'h1'          => 'Compresser une photo en ligne',
        'subtitle'    => 'Réduisez le poids de vos photos sans dégrader ce que vous voyez à l\'écran.',
        'intro'       => '<p>Les photos prises au smartphone ou à l\'appareil sont volontairement très détaillées, donc lourdes. Pour les partager par mail, les publier sur un site ou les joindre à un document, mieux vaut les compresser d\'abord.</p>
                          <p>Notre compresseur réduit le poids de vos photos tout en préservant les couleurs et les détails visibles. Idéal pour gagner de l\'espace sans sacrifier la qualité.</p>',
        'how'         => [
            ['Ajoutez vos photos', 'Une seule ou un lot complet, en JPG, PNG ou WebP.'],
            ['Choisissez la qualité', 'Recommandé offre le meilleur compromis poids/qualité.'],
            ['Enregistrez', 'Téléchargez vos photos allégées en un clic.'],
        ],
        'faq'         => [
            ['Quelle qualité choisir pour une photo ?', 'Le niveau « Recommandé » convient à la plupart des cas : il divise le poids par 2 à 4 sans différence visible. Réservez « Fort » aux usages où le poids prime sur le détail.'],
            ['Perd-on les couleurs de la photo ?', 'Non, les couleurs et la luminosité sont conservées. Seules les informations invisibles à l\'œil sont supprimées pour gagner du poids.'],
            ['Puis-je compresser une photo d\'appareil photo (RAW) ?', 'L\'outil traite les photos exportées en JPG, PNG ou WebP. Exportez d\'abord votre RAW dans l\'un de ces formats, puis compressez-le ici.'],
        ],
    ],

    'reduire-taille-photo' => [
        'title'       => 'Réduire la taille d\'une photo en ligne — Gratuit et rapide',
        'description' => 'Réduisez la taille de vos photos en ligne gratuitement. Diminuez le poids de vos photos JPG, PNG et WebP en quelques secondes, sans perte visible.',
        'h1'          => 'Réduire la taille d\'une photo',
        'subtitle'    => 'Diminuez le poids de vos photos en quelques secondes, gratuitement.',
        'intro'       => '<p>« Réduire la taille d\'une photo » désigne le plus souvent réduire son poids (en Mo), pour qu\'elle prenne moins de place ou passe les limites d\'envoi. C\'est exactement ce que fait la compression.</p>
                          <p>Déposez votre photo, l\'outil la ré-encode intelligemment et vous rend un fichier nettement plus léger, sans toucher à ce qui est visible.</p>',
        'how'         => [
            ['Importez la photo', 'Glissez-la dans la zone de dépôt ci-dessus.'],
            ['Sélectionnez le niveau', 'Plus le niveau est fort, plus le poids baisse.'],
            ['Téléchargez', 'Votre photo réduite est prête immédiatement.'],
        ],
        'faq'         => [
            ['Réduire la taille = réduire les dimensions en pixels ?', 'Pas forcément. Ici on réduit le poids du fichier (Mo) sans changer la définition. La méga-compression Pro peut aussi redimensionner les très grandes images au-delà de 2000 px.'],
            ['De combien le poids peut-il baisser ?', 'Selon la photo, de 40 à 80 %. Une photo JPG de 5 Mo descend souvent autour de 1 à 1,5 Mo au niveau Recommandé.'],
            ['Est-ce gratuit ?', 'Oui, la réduction de poids est gratuite et sans inscription.'],
        ],
    ],

    'reduire-poids-image' => [
        'title'       => 'Réduire le poids d\'une image en ligne — Gratuit, sans perte visible',
        'description' => 'Réduisez le poids de vos images en ligne gratuitement. Allégez vos fichiers PNG, JPG et WebP en Ko ou Mo sans altérer la qualité visible.',
        'h1'          => 'Réduire le poids d\'une image',
        'subtitle'    => 'Allégez vos fichiers image en Ko ou Mo, sans altérer la qualité visible.',
        'intro'       => '<p>Le « poids » d\'une image, c\'est l\'espace qu\'elle occupe sur le disque, exprimé en Ko ou en Mo. Un poids élevé ralentit les pages web et alourdit les e-mails. Le réduire améliore la vitesse et la facilité de partage.</p>
                          <p>Notre outil applique la compression la plus adaptée à chaque format pour faire baisser le poids au maximum tout en gardant un rendu net.</p>',
        'how'         => [
            ['Chargez votre image', 'PNG, JPG ou WebP, une ou plusieurs.'],
            ['Réglez l\'intensité', 'Léger, Recommandé ou Fort selon le gain souhaité.'],
            ['Récupérez le fichier', 'Téléchargez votre image allégée.'],
        ],
        'faq'         => [
            ['Poids et qualité, faut-il choisir ?', 'Pas vraiment : une bonne compression réduit le poids en supprimant surtout des données invisibles. La qualité perçue reste quasi intacte aux niveaux Léger et Recommandé.'],
            ['Quel format pèse le moins ?', 'À qualité égale, le WebP est généralement le plus léger, devant le JPG puis le PNG. Pour une photo destinée au web, le WebP est souvent le meilleur choix.'],
            ['L\'outil garde-t-il la transparence du PNG ?', 'Oui, la transparence est préservée lors de la compression des PNG.'],
        ],
    ],

    'diminuer-taille-image' => [
        'title'       => 'Diminuer la taille d\'une image en ligne — Outil gratuit',
        'description' => 'Diminuez la taille de vos images gratuitement en ligne. Réduisez le poids de vos fichiers PNG, JPG et WebP sans logiciel ni inscription.',
        'h1'          => 'Diminuer la taille d\'une image',
        'subtitle'    => 'Faites baisser le poids de vos images en quelques secondes, sans installer de logiciel.',
        'intro'       => '<p>Vous devez diminuer la taille d\'une image pour respecter une limite d\'upload, accélérer un site ou libérer de l\'espace ? La compression est la méthode la plus simple et la plus rapide.</p>
                          <p>Aucun logiciel à installer : l\'outil fonctionne en ligne, sur tous les appareils, et reste gratuit.</p>',
        'how'         => [
            ['Déposez l\'image', 'Directement depuis votre ordinateur ou mobile.'],
            ['Choisissez le niveau', 'Du plus doux au plus fort selon le poids visé.'],
            ['Téléchargez', 'Votre image diminuée est prête immédiatement.'],
        ],
        'faq'         => [
            ['Comment diminuer la taille sans perdre en qualité ?', 'Restez sur le niveau Léger ou Recommandé : la baisse de poids est importante alors que la différence visuelle reste imperceptible.'],
            ['Faut-il un logiciel comme Photoshop ?', 'Non. Cet outil en ligne remplace un logiciel pour la simple compression, sans installation ni abonnement.'],
            ['Mes fichiers sont-ils sécurisés ?', 'Oui, ils sont supprimés automatiquement après traitement et ne sont jamais partagés.'],
        ],
    ],

    'alleger-une-image' => [
        'title'       => 'Alléger une image en ligne gratuitement — PNG, JPG, WebP',
        'description' => 'Allégez vos images gratuitement en ligne. Réduisez le poids de vos fichiers PNG, JPG et WebP sans perte de qualité visible, sans inscription.',
        'h1'          => 'Alléger une image',
        'subtitle'    => 'Rendez vos images plus légères pour le web et le partage, sans perte visible.',
        'intro'       => '<p>Alléger une image, c\'est réduire son poids pour qu\'elle se charge plus vite et se partage plus facilement. C\'est un réflexe indispensable avant de publier sur un site ou d\'envoyer un document.</p>
                          <p>Notre compresseur allège vos PNG, JPG et WebP automatiquement, en gardant le meilleur rendu possible pour le poids obtenu.</p>',
        'how'         => [
            ['Importez', 'Une image ou un lot complet.'],
            ['Compressez', 'Choisissez l\'intensité d\'allègement.'],
            ['Téléchargez', 'Récupérez vos images allégées.'],
        ],
        'faq'         => [
            ['Pourquoi alléger ses images ?', 'Des images légères accélèrent le chargement des pages (meilleur SEO et meilleure expérience), passent plus facilement par e-mail et consomment moins de stockage.'],
            ['Jusqu\'où peut-on alléger une image ?', 'Souvent de 50 à 80 % du poids initial, selon le format et le contenu, sans dégradation visible.'],
            ['Est-ce réversible ?', 'La compression « avec perte » ne se défait pas : conservez votre original si vous en avez besoin en pleine qualité plus tard.'],
        ],
    ],

    'compresser-plusieurs-images' => [
        'title'       => 'Compresser plusieurs images à la fois — Compression par lot gratuite',
        'description' => 'Compressez plusieurs images en même temps, gratuitement. Importez un lot de fichiers PNG, JPG ou WebP et téléchargez-les tous compressés.',
        'h1'          => 'Compresser plusieurs images à la fois',
        'subtitle'    => 'Importez un lot complet, compressez tout d\'un coup, téléchargez en une fois.',
        'intro'       => '<p>Compresser ses images une par une fait perdre du temps. Avec la compression par lot, vous déposez plusieurs fichiers en même temps et l\'outil les traite tous, puis vous propose un téléchargement groupé.</p>
                          <p>Parfait pour préparer une galerie, un catalogue produit ou tout un dossier de photos avant publication.</p>',
        'how'         => [
            ['Sélectionnez plusieurs fichiers', 'Maintenez Ctrl (ou Cmd) pour en choisir plusieurs, ou glissez tout le dossier.'],
            ['Lancez la compression', 'Le même réglage s\'applique à toutes les images du lot.'],
            ['Tout télécharger', 'Récupérez l\'ensemble de vos images compressées en un clic.'],
        ],
        'faq'         => [
            ['Combien d\'images puis-je traiter en une fois ?', 'Le mode gratuit permet de traiter un lot d\'images ; le mode Pro augmente la limite par lot et la taille maximale de chaque fichier.'],
            ['Les formats peuvent-ils être mélangés ?', 'Oui, vous pouvez déposer en même temps des PNG, des JPG et des WebP : chacun est compressé avec la méthode adaptée.'],
            ['Le réglage est-il le même pour toutes ?', 'Le niveau choisi s\'applique à tout le lot, ce qui garantit un résultat homogène.'],
        ],
    ],

    'compresser-image-sans-perte' => [
        'title'       => 'Compresser une image sans perte de qualité — Gratuit en ligne',
        'description' => 'Compressez vos images sans perte de qualité visible. Réduisez le poids de vos PNG, JPG et WebP tout en conservant un rendu net, gratuitement.',
        'h1'          => 'Compresser une image sans perte de qualité',
        'subtitle'    => 'Réduisez le poids de vos images en gardant un rendu identique à l\'œil.',
        'intro'       => '<p>« Sans perte » a deux sens. Au sens strict, la compression sans perte (lossless) réduit le poids sans modifier le moindre pixel — c\'est le cas du PNG optimisé. Au sens courant, on parle de compression « sans perte visible » : le fichier est plus léger et la différence est imperceptible.</p>
                          <p>Notre outil privilégie ce compromis : un poids fortement réduit pour une qualité que l\'œil ne distingue pas de l\'original.</p>',
        'how'         => [
            ['Ajoutez votre image', 'PNG pour le lossless, JPG/WebP pour le « sans perte visible ».'],
            ['Restez sur Léger', 'Le niveau Léger maximise la fidélité à l\'original.'],
            ['Téléchargez', 'Comparez avant/après, puis enregistrez.'],
        ],
        'faq'         => [
            ['Le JPG peut-il être compressé sans perte ?', 'Le JPG est par nature un format « avec perte ». Mais au niveau Léger, la perte est invisible. Pour un vrai sans perte, utilisez le PNG.'],
            ['Comment vérifier qu\'il n\'y a pas de perte visible ?', 'L\'outil affiche le résultat avant le téléchargement : vous pouvez comparer l\'image compressée à l\'originale et ajuster le niveau.'],
            ['Le PNG est-il vraiment sans perte ?', 'L\'optimisation PNG réduit le poids surtout via la palette de couleurs. Au niveau Léger, le rendu reste fidèle ; les niveaux plus forts privilégient le poids.'],
        ],
    ],

    'compresser-image-pour-mail' => [
        'title'       => 'Compresser une image pour l\'envoyer par mail — Gratuit',
        'description' => 'Compressez vos images pour les envoyer par e-mail sans dépasser la limite de pièce jointe. Réduisez le poids de vos photos JPG, PNG et WebP gratuitement.',
        'h1'          => 'Compresser une image pour l\'envoyer par mail',
        'subtitle'    => 'Passez sous la limite de pièce jointe sans renoncer à une image nette.',
        'intro'       => '<p>La plupart des messageries limitent les pièces jointes à 20 ou 25 Mo. Quelques photos non compressées suffisent à dépasser ce seuil et à faire échouer l\'envoi. Compresser vos images avant de les joindre règle le problème.</p>
                          <p>Réduisez le poids de chaque image, ajoutez-les à votre mail, et l\'envoi passe sans difficulté — même sur Gmail, Outlook ou Yahoo.</p>',
        'how'         => [
            ['Déposez vos images', 'Celles que vous voulez joindre à votre e-mail.'],
            ['Compressez', 'Le niveau Recommandé suffit pour la plupart des envois.'],
            ['Joignez-les au mail', 'Téléchargez puis attachez les fichiers allégés.'],
        ],
        'faq'         => [
            ['Quelle est la limite de pièce jointe par e-mail ?', 'Environ 25 Mo sur Gmail, 20 Mo sur Outlook et Yahoo. En compressant vos images, vous restez largement en dessous, même avec plusieurs photos.'],
            ['Le destinataire verra-t-il une différence ?', 'Non : au niveau Recommandé, l\'image reste nette à l\'écran. Seul le poids du fichier change.'],
            ['Puis-je compresser plusieurs photos pour un seul mail ?', 'Oui, déposez-les toutes en une fois et téléchargez le lot compressé avant de l\'attacher.'],
        ],
    ],

    'compresser-image-pour-wordpress' => [
        'title'       => 'Compresser une image pour WordPress — Site plus rapide, meilleur SEO',
        'description' => 'Compressez vos images avant de les téléverser sur WordPress. Réduisez le poids de vos visuels pour accélérer votre site et améliorer votre référencement.',
        'h1'          => 'Compresser une image pour WordPress',
        'subtitle'    => 'Des images légères pour un site WordPress rapide et mieux référencé.',
        'intro'       => '<p>Sur WordPress, les images représentent souvent la majeure partie du poids d\'une page. Des visuels non optimisés ralentissent le site, dégradent le score PageSpeed et pénalisent le référencement. Compresser vos images avant de les téléverser est la solution la plus efficace.</p>
                          <p>Allégez vos fichiers ici, puis importez-les dans votre médiathèque : vos pages se chargeront plus vite, sans plugin supplémentaire à installer.</p>',
        'how'         => [
            ['Préparez vos visuels', 'Compressez-les avant de les ajouter à la médiathèque.'],
            ['Choisissez le bon format', 'Le WebP est idéal pour le web ; sinon JPG pour les photos, PNG pour les logos.'],
            ['Téléversez dans WordPress', 'Importez les fichiers allégés dans vos articles et pages.'],
        ],
        'faq'         => [
            ['Faut-il un plugin comme Imagify ou ShortPixel ?', 'Pas obligatoirement. Compresser vos images en amont avec cet outil évite d\'alourdir WordPress d\'un plugin et de consommer un quota mensuel.'],
            ['Quelle taille d\'image pour WordPress ?', 'Visez des images au poids le plus faible possible pour une définition adaptée à votre thème (souvent 1200 à 1920 px de large). Le niveau Recommandé est un bon point de départ.'],
            ['Le WebP est-il compatible WordPress ?', 'Oui, WordPress accepte le WebP depuis la version 5.8. C\'est le format le plus léger pour accélérer un site.'],
        ],
    ],

    'compresser-image-pour-cv' => [
        'title'       => 'Compresser une photo pour un CV — Réduire le poids du fichier',
        'description' => 'Compressez la photo de votre CV pour réduire le poids du fichier. Idéal pour respecter les limites des sites d\'emploi et envoyer un CV léger par mail.',
        'h1'          => 'Compresser une photo pour un CV',
        'subtitle'    => 'Un CV plus léger, accepté partout, sans photo pixelisée.',
        'intro'       => '<p>Quand un CV est trop lourd, c\'est presque toujours la photo qui est en cause. Les sites de recrutement et les formulaires de candidature imposent souvent une limite de quelques Mo : une photo non optimisée peut suffire à bloquer l\'envoi.</p>
                          <p>Compressez votre photo avant de l\'insérer dans le CV, ou compressez directement le visuel exporté : le fichier devient plus léger tout en restant net et professionnel.</p>',
        'how'         => [
            ['Importez la photo', 'La photo destinée à votre CV, en JPG ou PNG.'],
            ['Compressez-la', 'Le niveau Recommandé garde un rendu net et professionnel.'],
            ['Insérez-la dans le CV', 'Téléchargez puis ajoutez-la à votre document.'],
        ],
        'faq'         => [
            ['Pourquoi mon CV est-il trop lourd ?', 'Dans la majorité des cas, c\'est la photo en haute définition qui alourdit le fichier. La compresser fait souvent passer le CV sous la limite demandée.'],
            ['La photo restera-t-elle nette sur le CV ?', 'Oui. Au niveau Recommandé, la photo conserve une qualité parfaitement adaptée à un CV imprimé ou envoyé en PDF.'],
            ['Faut-il compresser le CV ou la photo ?', 'Compressez la photo avant de l\'insérer. C\'est elle qui pèse le plus ; le texte du document, lui, est très léger.'],
        ],
    ],

    'reduire-taille-image-en-ligne' => [
        'title'       => 'Réduire la taille d\'une image en ligne — Gratuit, sans logiciel',
        'description' => 'Réduisez la taille de vos images en ligne gratuitement. Allégez le poids de vos fichiers PNG, JPG et WebP en quelques secondes, sans logiciel ni inscription.',
        'h1'          => 'Réduire la taille d\'une image en ligne',
        'subtitle'    => 'Allégez vos images directement dans le navigateur, sans rien installer.',
        'intro'       => '<p>Réduire la taille d\'une image en ligne, c\'est faire baisser son poids (en Ko ou Mo) sans passer par un logiciel de bureau. Pratique pour respecter une limite d\'upload, accélérer un site ou envoyer une photo rapidement.</p>
                          <p>L\'outil fonctionne entièrement dans le navigateur : vous déposez, vous compressez, vous téléchargez. Gratuit et sans inscription.</p>',
        'how'         => [
            ['Ouvrez l\'image', 'Glissez votre fichier dans la zone de dépôt.'],
            ['Ajustez la compression', 'Choisissez le niveau adapté à votre besoin.'],
            ['Enregistrez', 'Téléchargez votre image réduite.'],
        ],
        'faq'         => [
            ['En ligne ou logiciel : quelle différence ?', 'Un outil en ligne ne nécessite aucune installation et fonctionne sur tous les appareils. Pour de la simple compression, il remplace avantageusement un logiciel.'],
            ['La réduction est-elle vraiment gratuite ?', 'Oui, sans inscription ni limite d\'usage pour les fichiers standard. Le mode Pro ne sert qu\'aux gros fichiers et à la méga-compression.'],
            ['Mes images restent-elles confidentielles ?', 'Oui : elles sont supprimées automatiquement après la compression et ne sont jamais conservées.'],
        ],
    ],

];
