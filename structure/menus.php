<?php
class menus {
    public function main_menu() {
?>
        <div class="topnav">
            <a href="?page=home">Home</a>
            <a href="?page=about">About Us</a>
            <a href="?page=projects">Our Projects</a>
            <a href="?page=portfolio">Our Portfolio</a>
            <a href="?page=blog">Blog</a>
            <a href="?page=contact">Contact Us</a>
        </div>
<?php
    }

    public function display_content() {
        if (isset($_GET['page']) && $_GET['page'] == 'home') {
            echo '<div class="content">INTERNET APPLICATION PROGRAMMING</div>';
        }
    }
}

$menu = new menus();
$menu->main_menu();
$menu->display_content();
?>
