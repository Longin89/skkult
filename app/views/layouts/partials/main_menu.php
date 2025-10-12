  <?php

    use App\Models\Contacts;
    use Core\Router;
    use Core\H;
    use App\Models\Users;

    $userMenu = Router::getMenu('user_menu');
    $menu = Router::getMenu('menu_acl');
    $currentPage = H::currentPage();
    $contacts = (new Contacts())->findFirst();
    ?>
  <div class="contain">
      <div class="header__container contain">
          <div class="header__logo">
<img src="/images/bear.png" alt="bear">
              <a href="<? ROOT ?>/home" class="header__logo-link">
                  СК <br>Культурист
              </a>
          </div>
          <nav class="header__nav">
              <div class="header__nav-burger burger-button">
                  <span class="header__burger-line burger-top"></span>
                  <span class="header__burger-line burger-middle"></span>
                  <span class="header__burger-line burger-bottom"></span>
              </div>
              <ul class="header__burger-list burger-menu">
                  <?php foreach ($menu as $key => $val): ?>
                      <li class="header__burger-item">
                          <a class="header__burger-link" href="<? echo $val; ?>"><? echo $key; ?></a>
                      </li>
                  <?php endforeach; ?>
              </ul>
              <ul class="header__nav-list">
                  <?php foreach ($menu as $key => $val): ?>
                      <li class="header__nav-item">
                          <a href="<? echo $val; ?>" class="header__nav-link">
                              <? echo $key; ?>
                          </a>
                      </li>
                  <?php endforeach; ?>
              </ul>
          </nav>
          <?php if (Users::currentUser()): ?>
              <ul class="nav navbar-nav navbar-right">
                  <?= H::buildMenuListItems($userMenu, "dropdown-menu-right"); ?>
              </ul>
          <?php else: ?>
              <ul class="header__contacts">
                  <li class="header__contacts-item">
                      <a href="tel:<?= $contacts->phone ?>" class="header__contacts-link" target="_blank" title="Позвонить">
                          <img src="/images/phone.webp" alt="phone">
                      </a>
                  </li>
                  <li class="header__contacts-item">
                      <a href="<?= $contacts->vk ?>" class="header__contacts-link" target="_blank"
                          title="ВКонтакте">
                          <img src="/images/vk.webp" alt="vk">
                      </a>
                  </li>
                  <li class="header__contacts-item">
                      <a href="https://wa.me/<?= $contacts->whatsup ?>" class="header__contacts-link" target="_blank" title="WhatsApp">
                          <img src="/images/whatsapp.webp" alt="whatsapp">
                      </a>
                  </li>
                  <li class="header__contacts-item">
                      <a href="mailto:<?= $contacts->email ?>" class="header__contacts-link" target="_blank" title="Email">
                          <img src="/images/email.webp" alt="email">
                      </a>
                  </li>
              </ul>
          <?php endif; ?>
      </div>
  </div>