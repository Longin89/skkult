  <?php

  use App\Models\Contacts;
  // Убрать в контроллер
  $contacts = Contacts::findFirst();
  ?>
  <footer class="footer">
    <div class="footer__container contain">
      <div class="footer__nav">
        <h2 class="footer__nav-title">
          Разделы сайта
        </h2>
        <ul class="footer__nav-list">
          <?php foreach ($menu as $key => $val): ?>
            <li class="footer__list-item">
              <a href="<? echo $val; ?>" class="footer__item-link">
                <? echo $key; ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
      <div class="footer__contacts">
        <h2 class="footer__contacts-title">
          Связаться с нами
        </h2>
        <ul class="footer__contacts-list">
          <li class="footer__list-item">
            <a href="tel:<?= $contacts->phone ?>" class="footer__contacts-link" target="_blank" title="Позвонить">
              <img src="/images/phone.webp" alt="phone">
            </a>
          </li>
          <li class="footer__list-item">
            <a href="<?= $contacts->vk ?>" class="footer__contacts-link" target="_blank" title="ВКонтакте">
              <img src="/images/vk.webp" alt="vk">
            </a>
          </li>
          <li class="footer__list-item">
            <a href="https://wa.me/<?= $contacts->whatsup ?>" class="footer__contacts-link" target="_blank" title="WhatsApp">
              <img src="/images/whatsapp.webp" alt="whatsapp">
            </a>
          </li>
          <li class="footer__list-item">
            <a href="mailto:<?= $contacts->email ?>" class="footer__contacts-link" target="_blank" title="Email">
              <img src="/images/email.webp" alt="email">
            </a>
          </li>
        </ul>
      </div>
      <div class="footer__worktime">
        <h2 class="footer__worktime-title">
          Режим работы
        </h2>
        <ul class="footer__worktime-list">
          <li class="footer__worktime-item">
            Пн. - чт.: 08:00 - 22:00
          </li>
          <li class="footer__worktime-item">
            Пт.: 07:00 - 20:00
          </li>
          <li class="footer__worktime-item">
            Сб.: 14:00 - 20:00
          </li>
          <li class="footer__worktime-item">
            Вс.: выходной
          </li>
        </ul>
      </div>
      <div class="footer__address">
        <h2 class="footer__address-title">
          Как нас найти
        </h2>
        <ul class="footer__address-list">
          <li class="footer__address-item">
            Республика Башкортостан
          </li>
          <li class="footer__address-item">
            г. Стерлитамак
          </li>
          <li class="footer__address-item">
            Ул. Дружбы 3, цокольный этаж
          </li>
        </ul>
      </div>
      <?= $this->content('footer'); ?>
    </div>
  </footer>