<?php
	if (!isset($current)){
		$current="";
	}
	if (!isset($product)){
		$product="";
	}
	if (!isset($currentCat)){
		$currentCat="";
	}
	if (!isset($currentSub)){
		$currentSub="";
	}
?>

<!-- header-container start -->
<div class="header-container">
  <header class="header fixed clearfix">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <!-- header-left start -->
          <!-- ================ -->
          <div class="header-left clearfix">
            <!-- logo -->
            <div id="logo" class="logo margin-top-10">
              <a href="index.php"
                ><img
                  id="logo_img"
                  src="images/encabezado/logo-nordeco.png"
                  alt="logo nordeco"
              /></a>
            </div>
          </div>
          <!-- header-left end -->
        </div>

        <div class="col-md-9">
          <!-- header-right start -->
          <!-- ================ -->
          <div class="header-right clearfix"></div>

          <!-- main-navigation start -->
          <!-- classes: -->
          <!-- "onclick": Makes the dropdowns open on click, this the default bootstrap behavior e.g. class="main-navigation onclick" -->
          <!-- "animated": Enables animations on dropdowns opening e.g. class="main-navigation animated" -->
          <!-- "with-dropdown-buttons": Mandatory class that adds extra space, to the main navigation, for the search and cart dropdowns -->
          <!-- ================ -->
          <div class="main-navigation animated with-dropdown-buttons">
            <!-- navbar start -->
            <!-- ================ -->
            <nav class="navbar navbar-default" role="navigation">
              <div class="container-fluid">
                <!-- Toggle get grouped for better mobile display -->
                <div class="navbar-header text-center">
                  <span class="menu">Menú</span>
                  <button
                    type="button"
                    class="navbar-toggle"
                    data-toggle="collapse"
                    data-target="#navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                </div>
                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-collapse-1">
                  <!-- main-menu -->
                  <ul class="nav navbar-nav">
                    <li class="dropdown">
                      <a
                        class="dropdown-toggle <?php if ($current == 'decks') echo ' active'; ?>"
                        data-toggle="dropdown"
                        href="#"
                        >PRODUCTOS</a
                      >
                      <ul class="dropdown-menu">
                        <li
                          class="dropdown <?php if ($product == 'deck') echo ' active'; ?>">
                          <a
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            href="#"
                            >DECKS ECOLÓGICOS</a
                          >
                          <ul class="dropdown-menu">
                            <li
                              class="<?php if ($current == 'contour') echo ' active'; ?>">
                              <a href="deck-ecologico-contour.php"
                                >Línea Trex Contour</a
                              >
                            </li>
                            <li
                              class="<?php if ($current == 'trascend') echo ' active'; ?>">
                              <a href="deck-ecologico-trascend.php"
                                >Línea Trex Trascend</a
                              >
                            </li>
                            <li
                              class="<?php if ($current == 'enhance') echo ' active'; ?>">
                              <a href="deck-ecologico-trex-enhance.php"
                                >Línea Trex Enhance</a
                              >
                            </li>
                            <li
                              class="<?php if ($current == 'coextruded') echo ' active'; ?>">
                              <a href="deck-ecologico-co-extruded.php"
                                >Línea Co-Extruded</a
                              >
                            </li>
                            <li
                              class="<?php if ($current == 'select') echo ' active'; ?>">
                              <a href="deck-ecologico-select.php"
                                >Línea Select</a
                              >
                            </li>
                          </ul>
                        </li>

                        <li
                          class="dropdown <?php if ($product == 'pisos') echo ' active'; ?>">
                          <a
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            href="#"
                            >PISOS RESISTENTES AL AGUA</a
                          >
                          <ul class="dropdown-menu">
                            <li
                              class="dropdown <?php if ($currentCat == 'pisos-pegar') echo ' active'; ?>">
                              <a
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                href="pisos-vinilicos-para-pegar.php"
                                >Pisos Vinílicos para pegar</a
                              >
                              <ul class="dropdown-menu">
                                <li
                                  class="<?php if ($currentSub == 'pegar-baldosa') echo ' active'; ?>">
                                  <a
                                    href="pisos-vinilicos-para-pegar-baldosas.php"
                                    >Baldosas</a
                                  >
                                </li>
                                <li
                                  class="<?php if ($currentSub == 'pegar-liston') echo ' active'; ?>">
                                  <a
                                    href="pisos-vinilicos-para-pegar-listones.php"
                                    >Listones</a
                                  >
                                </li>
                              </ul>
                            </li>

                            <li
                              class="dropdown <?php if ($currentCat == 'pisos-spc') echo ' active'; ?>">
                              <a
                                class="dropdown-toggle"
                                data-toggle="dropdown"
                                href="pisos-vinilicos-spc.php"
                                >Pisos SPC Sistema Click</a
                              >
                              <ul class="dropdown-menu">
                                <li
                                  class="<?php if ($currentSub == 'spc-baldosa') echo ' active'; ?>">
                                  <a href="pisos-vinilicos-spc-baldosas.php"
                                    >Baldosas</a
                                  >
                                </li>
                                <li
                                  class="<?php if ($currentSub == 'spc-liston') echo ' active'; ?>">
                                  <a href="pisos-vinilicos-spc-listones.php"
                                    >Listones</a
                                  >
                                </li>
                              </ul>
                            </li>

                            <li
                              class="<?php if ($current == 'pisoplast') echo ' active'; ?>">
                              <a href="pisos.php">Pisos Vinilicos Click</a>
                            </li>
                            <li
                              class="<?php if ($current == 'zocalos') echo ' active'; ?>">
                              <a href="zocalos.php">Zócalos Pisoplast</a>
                            </li>
                          </ul>
                        </li>

                        <li
                          class="dropdown <?php if ($product == 'revestimientos') echo ' active'; ?>">
                          <a
                            class="dropdown-toggle"
                            data-toggle="dropdown"
                            href="#"
                            >REVESTIMIENTOS</a
                          >
                          <ul class="dropdown-menu">
                            <li
                              class="<?php if ($current == 'wall_panel') echo ' active'; ?>">
                              <a href="revestimientos-wall-panel.php"
                                >Wall Panel</a
                              >
                            </li>
                            <li
                              class="<?php if ($current == 'siding') echo ' active'; ?>">
                              <a href="revestimientos-siding.php">Siding</a>
                            </li>
                            <li
                              class="<?php if ($current == 'perfiles') echo ' active'; ?>">
                              <a href="revestimientos-perfiles.php"
                                >Perfiles WPC</a
                              >
                            </li>
                          </ul>
                        </li>

                        <li
                          class="<?php if ($current == 'teto') echo ' active'; ?>">
                          <a
                            href="cielorrasos-premium-tetovinilico-argentina.php"
                            class="dropdown-toggle"
                            >TECHOS ARQUITECTÓNICOS<br />TETO VINÍLICO ARGENTINA</a
                          >
                        </li>

                        <li
                          class="<?php if ($current == 'zocalos') echo ' active'; ?>">
                          <a href="zocalos.php" class="dropdown-toggle"
                            >ZÓCALOS</a
                          >
                        </li>

                        <li
                          class="<?php if ($current == 'muebles') echo ' active'; ?>">
                          <a href="muebles.php" class="dropdown-toggle"
                            >MUEBLES DE EXTERIOR</a
                          >
                        </li>

                        <li
                          class="<?php if ($current == 'laminas') echo ' active'; ?>">
                          <a href="laminas.php" class="dropdown-toggle"
                            >LÁMINAS DE PIEDRA</a
                          >
                        </li>
                      </ul>
                    </li>

                    <li
                      class="<?php if ($current == 'portfolio') echo ' active'; ?>">
                      <a
                        href="deck-ecologico-color-roble.php"
                        class="dropdown-toggle"
                        >PORTFOLIO</a
                      >
                    </li>

                    <li
                      class="<?php if ($current == 'contacto') echo ' active'; ?>">
                      <a href="contacto.php" class="dropdown-toggle"
                        >CONTACTO</a
                      >
                    </li>
                  </ul>
                  <!-- main-menu end -->

                  <!-- Whatsapp -->
                  <div class="whatsapp">
                    <a
                      href="https://api.whatsapp.com/send?phone=+5491153117118&text=Hola!%20Necesito%20hacer%20una%20consulta!"
                      target="_blank">
                      <img
                        id="whatsapp"
                        src="images/header/whatsap.png"
                        alt="whatsapp" />
                    </a>
                    <p>
                      <strong>WhatsApp</strong><br />
                      Lu. - Vi.<br />
                      08 - 17 hs.
                    </p>
                  </div>
                  <!-- Whatsapp end -->
                </div>
              </div>
            </nav>
            <!-- navbar end -->
          </div>
          <!-- main-navigation end -->
        </div>
      </div>
    </div>
  </header>
  <!-- header end -->
</div>
<!-- header-container end -->
