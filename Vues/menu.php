<div class="navbar-collapse collapse w-100" id="navbar3">
        <ul class="navbar-nav w-100">
            <li class="nav-item active">
                <ul class="dropdown spec-bot">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown">Les Films<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php echo '<li><a href="index.php?login='.$_GET['login'].'&vue=film&action=visualiser" style="margin-left : 5px;">Voir tous les films</a></li>' ?>
                    </ul>
                </ul>    
            </li>
            <li class="nav-item active">
                <ul class="dropdown">
                    <button class="btn btn-secondary ml-auto dropdown-toggle" type="button" data-toggle="dropdown">Les Séries<span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <?php echo '<li><a href="index.php?login='.$_GET['login'].'&vue=serie&action=visualiser" style="margin-left : 5px;">Voir toutes les séries</a></li>' ?>
                    </ul>
                </ul>    
            </li>
        </ul>

        <ul class="nav navbar-nav ml-auto pos-avatar justify-content-end">

            <li class="nav-item active">
                <ul class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle btn-avatar" type="button" data-toggle="dropdown"><img class="avatar" src="https://upload.wikimedia.org/wikipedia/commons/7/7c/Profile_avatar_placeholder_large.png"><span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <!--<li><a href="index.php?vue=compte&action=verifLogin">Se connecter</a></li>-->
                        <li><a href="index.php?vue=compte&action=visualiser" style="margin-left : 5px;">Voir mon profil</a></li>
                        <li><a href='index.php?vue=compte&action=modifier' style="margin-left : 5px;">Modifier mon profil</a></li>
						<li><a href='index.php?vue=compte&action=visuEmprunt' style="margin-left : 5px;">Mes Emprunts</a></li>
						<li><a href='index.php?action=visualiser&vue=accueil' style="margin-left : 5px;">Se déconnecter</a></li>
                    </ul>
                </ul>    
            </li>
        </ul>
    </div>
</nav>
