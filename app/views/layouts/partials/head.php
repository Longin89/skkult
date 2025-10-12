<!doctype html>
<html lang="ru" class="page">

<head>
  <?php

  use App\Models\Users;
  use Core\H;
  ?>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="description" content="<?= htmlspecialchars($this->metaDescription(), ENT_QUOTES, 'UTF-8'); ?>"/>
  <link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
  <link rel="preload" href="/fonts/Inter-Regular.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="/fonts/Poppins-Bold.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="/fonts/TheCrewPro.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="/fonts/Lordcorps.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="preload" href="/fonts/HandveticaNeue.woff2" as="font" type="font/woff2" crossorigin />
  <link rel="stylesheet" href="/css/style.min.css" />
  <link rel="canonical" href="https://www.skkulturist.ru">
  <meta property="og:type" content="website" />
  <meta property="og:locale" content="ru_RU" />
  <meta property="og:site_name" content="<?= htmlspecialchars(SITE_TITLE, ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:title" content="<?= htmlspecialchars($this->siteTitle(), ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:description" content="<?= htmlspecialchars($this->metaDescription(), ENT_QUOTES, 'UTF-8'); ?>" />
  <meta property="og:image" content="<?= BASE_URL; ?>/images/gym1.jpg" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?= htmlspecialchars($this->siteTitle(), ENT_QUOTES, 'UTF-8'); ?>" />
  <meta name="twitter:description" content="<?= htmlspecialchars($this->metaDescription(), ENT_QUOTES, 'UTF-8'); ?>" />
  <meta name="twitter:image" content="<?= BASE_URL; ?>/images/gym1.jpg" />
  <!-- Yandex.Metrika counter -->
  <script type="text/javascript">
    (function(m, e, t, r, i, k, a) {
      m[i] = m[i] || function() {
        (m[i].a = m[i].a || []).push(arguments)
      };
      m[i].l = 1 * new Date();
      for (var j = 0; j < document.scripts.length; j++) {
        if (document.scripts[j].src === r) {
          return;
        }
      }
      k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
    })(window, document, 'script', 'https://mc.yandex.ru/metrika/tag.js?id=103541620', 'ym');

    ym(103541620, 'init', {
      ssr: true,
      webvisor: true,
      clickmap: true,
      ecommerce: "dataLayer",
      accurateTrackBounce: true,
      trackLinks: true
    });
  </script>
  <noscript>
    <div><img src="https://mc.yandex.ru/watch/103541620" style="position:absolute; left:-9999px;" alt="" /></div>
  </noscript>
  <!-- /Yandex.Metrika counter -->
  <script defer src="/js/main.bundle.js"></script>
  <script src="https://api-maps.yandex.ru/2.1/?apikey=31830af7-45e9-48ad-9f63-c4d696b5808f&lang=ru"></script>
  <?php if (Users::$currentLoggedInUser && Users::$currentLoggedInUser->username == 'admin'): ?>
    <link rel="stylesheet" href="/css/bootstrap.min.css" />
    <script src="/js/bootstrap.bundle.min.js"></script>
  <?php endif; ?>
  <title><?= $this->siteTitle(); ?></title>
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "SportsActivityLocation",
    "name": "<?= htmlspecialchars(SITE_TITLE, ENT_QUOTES, 'UTF-8'); ?>",
    "url": "<?= BASE_URL; ?>",
    "address": {
      "@type": "PostalAddress",
      "addressCountry": "RU",
      "addressRegion": "Республика Башкортостан",
      "addressLocality": "Стерлитамак",
      "streetAddress": "Ул. Дружбы 3, цокольный этаж"
    }
  }
  </script>
  <?= $this->content('head'); ?>
</head>