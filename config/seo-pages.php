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
        'title'       => 'Compresser plusieurs images à la fois — Lot gratuit',
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

    // ───────── Conversion de format (cluster « convertir X en Y ») ─────────

    'convertir-png-en-jpg' => [
        'title'       => 'Convertir un PNG en JPG en ligne gratuitement',
        'description' => 'Convertissez vos images PNG en JPG en ligne, gratuitement et sans inscription. Conversion instantanée dans le navigateur, vos fichiers restent privés.',
        'h1'          => 'Convertir un PNG en JPG',
        'subtitle'    => 'Transformez vos PNG en JPG en un clic — plus légers, parfaits pour les photos.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/jpeg', 'toLabel' => 'JPG'],
        'intro'       => '<p>Convertir un PNG en JPG est utile pour alléger une image : le JPG est bien plus compact que le PNG sur les photos. C\'est aussi le format attendu par de nombreux formulaires et sites qui n\'acceptent pas le PNG.</p>
                          <p>Déposez votre PNG, l\'outil le convertit en JPG directement dans votre navigateur. Si l\'image a un fond transparent, il devient blanc (le JPG ne gère pas la transparence).</p>',
        'how'         => [
            ['Déposez votre PNG', 'Glissez un ou plusieurs fichiers PNG.'],
            ['La conversion est automatique', 'Le format de sortie est réglé sur JPG.'],
            ['Téléchargez le JPG', 'Récupérez vos fichiers convertis, prêts à l\'emploi.'],
        ],
        'faq'         => [
            ['Pourquoi convertir un PNG en JPG ?', 'Le JPG est beaucoup plus léger que le PNG pour les photos, ce qui accélère les sites et facilite l\'envoi par mail. C\'est aussi le format accepté par la plupart des formulaires.'],
            ['Que devient la transparence du PNG ?', 'Le JPG ne supporte pas la transparence : les zones transparentes sont remplies en blanc lors de la conversion.'],
            ['La conversion est-elle gratuite ?', 'Oui, gratuite, sans inscription, et vos fichiers ne quittent pas votre appareil.'],
        ],
    ],

    'convertir-jpg-en-png' => [
        'title'       => 'Convertir un JPG en PNG en ligne gratuitement',
        'description' => 'Convertissez vos images JPG en PNG en ligne, gratuitement et sans inscription. Conversion instantanée dans le navigateur, sans perte de données.',
        'h1'          => 'Convertir un JPG en PNG',
        'subtitle'    => 'Passez vos JPG au format PNG, idéal pour l\'édition et les fonds unis.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/png', 'toLabel' => 'PNG'],
        'intro'       => '<p>Convertir un JPG en PNG est pratique quand vous avez besoin d\'un format sans compression destructrice — par exemple pour retoucher une image, ajouter de la transparence ensuite, ou répondre à une exigence technique.</p>
                          <p>Déposez votre JPG, l\'outil le ré-encode en PNG dans votre navigateur. Notez que le PNG d\'une photo est plus lourd que le JPG d\'origine.</p>',
        'how'         => [
            ['Importez votre JPG', 'Un ou plusieurs fichiers JPG/JPEG.'],
            ['Conversion automatique', 'Le format de sortie est réglé sur PNG.'],
            ['Téléchargez le PNG', 'Récupérez vos fichiers au format PNG.'],
        ],
        'faq'         => [
            ['Le PNG sera-t-il plus net que le JPG ?', 'Non : la conversion ne récupère pas les détails déjà perdus par le JPG. Le PNG conserve l\'image telle quelle, sans nouvelle compression destructrice.'],
            ['Pourquoi le fichier PNG est-il plus lourd ?', 'Le PNG est sans perte : pour une photo, il occupe plus d\'espace que le JPG. C\'est normal et inhérent au format.'],
            ['Puis-je ajouter de la transparence après ?', 'Oui, une fois en PNG vous pouvez détourer ou rendre des zones transparentes dans un éditeur d\'images.'],
        ],
    ],

    'convertir-png-en-webp' => [
        'title'       => 'Convertir un PNG en WebP en ligne gratuitement',
        'description' => 'Convertissez vos PNG en WebP en ligne gratuitement. Le WebP réduit fortement le poids tout en gardant la transparence. Idéal pour accélérer un site.',
        'h1'          => 'Convertir un PNG en WebP',
        'subtitle'    => 'Le format le plus léger pour le web, transparence conservée.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/webp', 'toLabel' => 'WebP'],
        'intro'       => '<p>Le WebP offre une bien meilleure compression que le PNG tout en conservant la transparence. Convertir vos PNG en WebP est l\'une des optimisations les plus efficaces pour accélérer un site web et améliorer son score PageSpeed.</p>
                          <p>Déposez vos PNG, l\'outil les convertit en WebP directement dans le navigateur, sans perte visible.</p>',
        'how'         => [
            ['Déposez vos PNG', 'Un fichier ou un lot complet.'],
            ['Conversion en WebP', 'Le format de sortie est réglé sur WebP.'],
            ['Téléchargez', 'Récupérez vos WebP allégés pour le web.'],
        ],
        'faq'         => [
            ['Le WebP garde-t-il la transparence ?', 'Oui, contrairement au JPG, le WebP conserve la transparence du PNG tout en étant beaucoup plus léger.'],
            ['De combien le poids baisse-t-il ?', 'Souvent de 70 à 90 % par rapport au PNG d\'origine, sans différence visible à l\'écran.'],
            ['Le WebP est-il compatible partout ?', 'Tous les navigateurs modernes et WordPress (depuis la 5.8) acceptent le WebP. C\'est aujourd\'hui un format standard du web.'],
        ],
    ],

    'convertir-jpg-en-webp' => [
        'title'       => 'Convertir un JPG en WebP en ligne gratuitement',
        'description' => 'Convertissez vos JPG en WebP en ligne gratuitement. Le WebP est plus léger que le JPG à qualité égale : idéal pour accélérer votre site web.',
        'h1'          => 'Convertir un JPG en WebP',
        'subtitle'    => 'Des photos plus légères qu\'en JPG, sans perte de qualité visible.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/webp', 'toLabel' => 'WebP'],
        'intro'       => '<p>À qualité égale, le WebP est plus léger que le JPG. Convertir vos photos JPG en WebP réduit le poids de vos pages et améliore les performances, sans dégradation visible.</p>
                          <p>Déposez vos JPG, l\'outil les convertit en WebP dans le navigateur. C\'est le format recommandé par Google pour les images du web.</p>',
        'how'         => [
            ['Importez vos JPG', 'Un ou plusieurs fichiers JPG/JPEG.'],
            ['Conversion en WebP', 'Le format de sortie est réglé sur WebP.'],
            ['Téléchargez', 'Récupérez vos WebP prêts pour le web.'],
        ],
        'faq'         => [
            ['Le WebP est-il vraiment plus léger que le JPG ?', 'Oui, généralement de 25 à 35 % à qualité équivalente, ce qui réduit d\'autant le temps de chargement de vos pages.'],
            ['Y a-t-il une perte de qualité ?', 'À qualité comparable, la différence est invisible à l\'œil. Le WebP gère très bien les photos.'],
            ['Google recommande-t-il le WebP ?', 'Oui, PageSpeed Insights conseille explicitement le WebP (et l\'AVIF) pour servir des images plus légères.'],
        ],
    ],

    'convertir-webp-en-jpg' => [
        'title'       => 'Convertir un WebP en JPG en ligne gratuitement',
        'description' => 'Convertissez vos images WebP en JPG en ligne gratuitement. Pratique pour ouvrir un WebP dans un logiciel ou un site qui n\'accepte que le JPG.',
        'h1'          => 'Convertir un WebP en JPG',
        'subtitle'    => 'Rendez vos WebP compatibles partout en les convertissant en JPG.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/jpeg', 'toLabel' => 'JPG'],
        'intro'       => '<p>Certains logiciels, imprimeurs ou formulaires n\'acceptent pas encore le WebP. Convertir un WebP en JPG les rend immédiatement compatibles, tout en restant légers.</p>
                          <p>Déposez votre WebP, l\'outil le convertit en JPG dans le navigateur. Les éventuelles zones transparentes deviennent blanches.</p>',
        'how'         => [
            ['Déposez votre WebP', 'Un ou plusieurs fichiers WebP.'],
            ['Conversion en JPG', 'Le format de sortie est réglé sur JPG.'],
            ['Téléchargez le JPG', 'Un fichier compatible avec tous les outils.'],
        ],
        'faq'         => [
            ['Pourquoi convertir un WebP en JPG ?', 'Pour ouvrir ou envoyer l\'image dans un outil qui ne reconnaît pas le WebP : vieux logiciels, certaines plateformes ou services d\'impression.'],
            ['Vais-je perdre en qualité ?', 'La conversion ré-encode l\'image ; au niveau de qualité standard, la différence reste imperceptible.'],
            ['La transparence est-elle conservée ?', 'Non, le JPG ne gère pas la transparence : les zones transparentes deviennent blanches.'],
        ],
    ],

    'convertir-webp-en-png' => [
        'title'       => 'Convertir un WebP en PNG en ligne gratuitement',
        'description' => 'Convertissez vos images WebP en PNG en ligne gratuitement. Conservez la transparence et rendez vos fichiers compatibles avec tous les logiciels.',
        'h1'          => 'Convertir un WebP en PNG',
        'subtitle'    => 'Récupérez un PNG compatible partout, avec transparence préservée.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/png', 'toLabel' => 'PNG'],
        'intro'       => '<p>Convertir un WebP en PNG permet d\'ouvrir l\'image dans n\'importe quel logiciel et de conserver la transparence, là où le WebP n\'est pas pris en charge.</p>
                          <p>Déposez votre WebP, l\'outil le convertit en PNG dans le navigateur, sans perte.</p>',
        'how'         => [
            ['Importez votre WebP', 'Un ou plusieurs fichiers WebP.'],
            ['Conversion en PNG', 'Le format de sortie est réglé sur PNG.'],
            ['Téléchargez le PNG', 'Compatible avec tous les éditeurs d\'images.'],
        ],
        'faq'         => [
            ['La transparence est-elle conservée ?', 'Oui, le PNG gère la transparence : les zones transparentes du WebP sont préservées.'],
            ['Le PNG sera-t-il plus lourd ?', 'Souvent oui, car le PNG est sans perte. C\'est le compromis pour une compatibilité maximale et la transparence.'],
            ['Est-ce gratuit et privé ?', 'Oui : la conversion est gratuite et se fait dans votre navigateur, vos fichiers ne sont pas envoyés sur un serveur.'],
        ],
    ],

    'convertir-image-en-webp' => [
        'title'       => 'Convertir une image en WebP en ligne gratuitement',
        'description' => 'Convertissez n\'importe quelle image (JPG, PNG) en WebP en ligne gratuitement. Réduisez le poids de vos visuels pour un site plus rapide.',
        'h1'          => 'Convertir une image en WebP',
        'subtitle'    => 'JPG ou PNG vers WebP : le format le plus léger pour le web.',
        'widget'      => ['mode' => 'convert', 'output' => 'image/webp', 'toLabel' => 'WebP'],
        'intro'       => '<p>Le WebP combine les avantages du JPG (légèreté des photos) et du PNG (transparence) avec une compression supérieure. Convertir vos images en WebP est l\'un des meilleurs moyens d\'accélérer un site.</p>
                          <p>Déposez vos JPG ou PNG, l\'outil les convertit tous en WebP dans le navigateur.</p>',
        'how'         => [
            ['Déposez vos images', 'JPG ou PNG, une ou plusieurs.'],
            ['Conversion en WebP', 'Le format de sortie est réglé sur WebP.'],
            ['Téléchargez', 'Récupérez vos WebP optimisés pour le web.'],
        ],
        'faq'         => [
            ['Quels formats puis-je convertir en WebP ?', 'Les JPG et les PNG. Chacun est ré-encodé en WebP, plus léger, directement dans votre navigateur.'],
            ['Le WebP dégrade-t-il l\'image ?', 'Non de façon visible : à qualité standard, le rendu est identique pour un poids nettement inférieur.'],
            ['Pourquoi passer au WebP ?', 'Pour des pages plus rapides, un meilleur score PageSpeed et un meilleur référencement, sans changer l\'apparence de vos images.'],
        ],
    ],

    // ───────── Compression à taille cible (cluster « image en X Ko/Mo ») ─────────

    'reduire-image-en-ko' => [
        'title'       => 'Réduire une image en Ko — Compression à la taille voulue',
        'description' => 'Réduisez une image au poids exact souhaité en Ko. Indiquez la taille cible, l\'outil ajuste automatiquement la qualité. Gratuit et en ligne.',
        'h1'          => 'Réduire une image en Ko',
        'subtitle'    => 'Indiquez le poids voulu, l\'outil ajuste la qualité pour l\'atteindre.',
        'widget'      => ['mode' => 'target', 'default' => 100, 'unit' => 'kb'],
        'intro'       => '<p>Beaucoup de formulaires en ligne imposent un poids maximal précis (par exemple 100 Ko ou 200 Ko). Plutôt que de tâtonner avec des niveaux de compression, indiquez directement la taille cible en Ko : l\'outil cherche automatiquement la meilleure qualité qui tient sous ce poids.</p>
                          <p>Tout se passe dans le navigateur. Vous obtenez une image qui respecte la limite, sans essais successifs.</p>',
        'how'         => [
            ['Déposez votre image', 'PNG, JPG ou WebP.'],
            ['Indiquez la taille en Ko', 'Par exemple 100 ou 200 Ko.'],
            ['Téléchargez', 'L\'outil ajuste la qualité pour rester sous la limite.'],
        ],
        'faq'         => [
            ['Comment l\'outil atteint-il le poids exact ?', 'Il teste plusieurs niveaux de qualité et retient le plus élevé qui reste sous votre cible. La taille finale est donc inférieure ou égale au poids demandé.'],
            ['Et si la cible est trop basse ?', 'Si même la qualité minimale dépasse la cible (image très grande), l\'outil fournit la version la plus légère possible. Réduisez d\'abord les dimensions si besoin.'],
            ['Quels formats sont supportés ?', 'JPG et WebP se prêtent le mieux au poids cible. Un PNG est automatiquement encodé en WebP pour pouvoir viser une taille précise.'],
        ],
    ],

    'compresser-image-en-mo' => [
        'title'       => 'Compresser une image en Mo — Atteindre un poids précis',
        'description' => 'Compressez une image jusqu\'à un poids en Mo défini. Indiquez la taille cible, l\'outil ajuste la qualité automatiquement. Gratuit, en ligne.',
        'h1'          => 'Compresser une image en Mo',
        'subtitle'    => 'Fixez un poids en Mo, l\'outil s\'occupe du réglage de qualité.',
        'widget'      => ['mode' => 'target', 'default' => 1, 'unit' => 'mb'],
        'intro'       => '<p>Pour respecter une limite exprimée en Mo (souvent 1, 2 ou 5 Mo), indiquez directement le poids cible : l\'outil ajuste la qualité pour que l\'image passe sous ce seuil, sans manipulation manuelle.</p>
                          <p>Idéal pour les pièces jointes, les dépôts de dossiers ou les plateformes qui plafonnent la taille des fichiers.</p>',
        'how'         => [
            ['Importez l\'image', 'PNG, JPG ou WebP.'],
            ['Choisissez le poids en Mo', '1, 2 ou 5 Mo selon la limite à respecter.'],
            ['Téléchargez', 'Votre image tient sous le poids demandé.'],
        ],
        'faq'         => [
            ['Puis-je viser exactement 2 Mo ?', 'Oui, saisissez 2 Mo : l\'outil produit une image dont le poids reste inférieur ou égal à cette valeur.'],
            ['Ko ou Mo, comment choisir ?', 'Utilisez les Mo pour les fichiers volumineux et les Ko pour les petites images. Vous pouvez changer d\'unité à tout moment.'],
            ['La qualité reste-t-elle correcte ?', 'L\'outil garde toujours la meilleure qualité possible compatible avec le poids cible.'],
        ],
    ],

    'compresser-image-100-ko' => [
        'title'       => 'Compresser une image en 100 Ko — Outil gratuit en ligne',
        'description' => 'Compressez une image à 100 Ko maximum en ligne gratuitement. L\'outil ajuste automatiquement la qualité pour respecter cette taille précise.',
        'h1'          => 'Compresser une image en 100 Ko',
        'subtitle'    => 'Atteignez la limite des 100 Ko sans tâtonner.',
        'widget'      => ['mode' => 'target', 'default' => 100, 'unit' => 'kb'],
        'intro'       => '<p>La limite de 100 Ko revient souvent sur les formulaires administratifs et les sites d\'inscription. Indiquez 100 Ko comme cible : l\'outil ajuste la qualité pour que votre image passe sous ce poids du premier coup.</p>
                          <p>Vous pouvez modifier la valeur si votre limite est différente (50, 200 Ko…).</p>',
        'how'         => [
            ['Déposez l\'image', 'PNG, JPG ou WebP.'],
            ['Cible : 100 Ko', 'Déjà pré-réglée, modifiable si besoin.'],
            ['Téléchargez', 'Une image conforme à la limite des 100 Ko.'],
        ],
        'faq'         => [
            ['L\'image fera-t-elle pile 100 Ko ?', 'Elle pèsera 100 Ko ou un peu moins : l\'outil retient la meilleure qualité qui reste sous la limite.'],
            ['Et pour une autre limite ?', 'Changez simplement la valeur (par exemple 50 ou 200 Ko) : le principe reste le même.'],
            ['Est-ce adapté aux photos d\'identité ?', 'Oui, c\'est un usage fréquent pour les démarches en ligne qui imposent un poids maximal.'],
        ],
    ],

    'compresser-image-20-ko' => [
        'title'       => 'Compresser une image en 20 Ko — Outil gratuit en ligne',
        'description' => 'Compressez une image à 20 Ko maximum en ligne gratuitement. Idéal pour les formulaires très restrictifs. La qualité s\'ajuste automatiquement.',
        'h1'          => 'Compresser une image en 20 Ko',
        'subtitle'    => 'Pour les formulaires les plus stricts, descendez jusqu\'à 20 Ko.',
        'widget'      => ['mode' => 'target', 'default' => 20, 'unit' => 'kb'],
        'intro'       => '<p>Certaines plateformes très restrictives n\'acceptent que des images de 20 Ko, voire moins. Indiquez 20 Ko comme cible : l\'outil pousse la compression au niveau nécessaire pour respecter cette limite.</p>
                          <p>Pour une cible aussi basse, mieux vaut partir d\'une image déjà réduite en dimensions.</p>',
        'how'         => [
            ['Déposez une petite image', 'Idéalement déjà redimensionnée.'],
            ['Cible : 20 Ko', 'Pré-réglée, modifiable selon votre limite.'],
            ['Téléchargez', 'Une image conforme à la limite des 20 Ko.'],
        ],
        'faq'         => [
            ['20 Ko est-il toujours atteignable ?', 'Pour une grande photo, pas toujours sans réduire d\'abord les dimensions. L\'outil fournit alors la version la plus légère possible.'],
            ['Comment maximiser mes chances ?', 'Réduisez la taille en pixels de l\'image avant la compression : moins de pixels, plus facile d\'atteindre un poids très bas.'],
            ['La qualité sera-t-elle suffisante ?', 'À 20 Ko, la qualité dépend des dimensions. Pour une vignette ou une petite photo, le rendu reste tout à fait correct.'],
        ],
    ],

    'compresser-image-1-mo' => [
        'title'       => 'Compresser une image en 1 Mo — Outil gratuit en ligne',
        'description' => 'Compressez une image à 1 Mo maximum en ligne gratuitement. L\'outil ajuste la qualité pour respecter cette taille tout en restant net.',
        'h1'          => 'Compresser une image en 1 Mo',
        'subtitle'    => 'Passez sous la barre des 1 Mo en gardant une belle qualité.',
        'widget'      => ['mode' => 'target', 'default' => 1, 'unit' => 'mb'],
        'intro'       => '<p>La limite de 1 Mo est l\'une des plus courantes pour les pièces jointes et les dépôts en ligne. Indiquez 1 Mo comme cible : l\'outil ajuste la qualité pour que votre image passe sous ce seuil tout en restant nette.</p>
                          <p>À ce poids, la qualité reste généralement excellente, même pour une photo en pleine définition.</p>',
        'how'         => [
            ['Importez votre image', 'PNG, JPG ou WebP.'],
            ['Cible : 1 Mo', 'Pré-réglée, modifiable si nécessaire.'],
            ['Téléchargez', 'Une image nette, sous la barre des 1 Mo.'],
        ],
        'faq'         => [
            ['1 Mo, est-ce suffisant pour une belle photo ?', 'Oui, largement : à 1 Mo une photo reste très détaillée. C\'est un excellent compromis poids/qualité.'],
            ['L\'image dépassera-t-elle 1 Mo ?', 'Non : l\'outil garantit un poids inférieur ou égal à la cible que vous indiquez.'],
            ['Puis-je viser 2 ou 5 Mo à la place ?', 'Oui, changez la valeur ou l\'unité selon la limite à respecter.'],
        ],
    ],

];
