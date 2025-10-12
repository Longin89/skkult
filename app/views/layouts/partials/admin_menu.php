  <?php

    use Core\Router;
    use Core\H;
    use App\Models\Users;
    ?>

  <?php
    // Передаем меню и acl
    $userMenu = Router::getMenu('user_menu');
    $menu = Router::getMenu('admin_menu_acl');
    $currentPage = H::currentPage();
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
                  <?php foreach ($menu as $key => $val):
                        $active = ''; ?>
                      <?php if (is_array($val)): ?>
                          <li class="header__nav-item dropdown">
                              <a class="header__nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false"><?= $key ?></a>
                              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                  <?php foreach ($val as $k => $v):
                                        $active = ($v == $currentPage) ? ' active ' : ''; ?>
                                      <li class="header__nav-item"><a class="<?= $active ?> dropdown-item header__nav-dropdown" href="<?= $v ?>"><?= $k ?></a></li>
                                  <?php endforeach; ?>
                              </ul>
                          </li>
                      <?php elseif ($key == 'Войти'): ?>
                          <li class="header__nav-item">
                              <button class="header__item-login" title="Личный кабинет">
                                  <svg width="16" height="21" viewBox="0 0 16 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M0 21C0 18.8783 0.842855 16.8434 2.34315 15.3431C3.84344 13.8429 5.87827 13 8 13C10.1217 13 12.1566 13.8429 13.6569 15.3431C15.1571 16.8434 16 18.8783 16 21H14C14 19.4087 13.3679 17.8826 12.2426 16.7574C11.1174 15.6321 9.5913 15 8 15C6.4087 15 4.88258 15.6321 3.75736 16.7574C2.63214 17.8826 2 19.4087 2 21H0ZM8 12C4.685 12 2 9.315 2 6C2 2.685 4.685 0 8 0C11.315 0 14 2.685 14 6C14 9.315 11.315 12 8 12ZM8 10C10.21 10 12 8.21 12 6C12 3.79 10.21 2 8 2C5.79 2 4 3.79 4 6C4 8.21 5.79 10 8 10Z" fill="#122947" />
                                  </svg>
                              </button>
                          </li>
                      <?php else:
                            $active = ($val == $currentPage) ? 'active' : '' ?>
                          <li class="header__list-item"><a class="<?= $active ?> header__nav-link" href="<?= $val ?>"><?= $key ?></a></li>
                      <?php endif; ?>
                  <?php endforeach; ?>
              </ul>
          </nav>
          <?php if (Users::currentUser()): ?>
              <ul class="nav navbar-nav navbar-right nav-user">
                  <?php if (Users::currentUser()): ?>
                      <?= H::buildMenuListItems($userMenu, "dropdown-menu-right"); ?>
                  <?php endif; ?>
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