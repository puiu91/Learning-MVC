<?php

/**
 * Class IndexController
 *
 */
class IndexController
{
    /**
     * Handles user request for index in the following cases:
     * 
     * 1 - application base level
     * 2 - localhost/index/index
     * 3 - localhost/index
     */
    public function index()
    {
        // header
        require APP_PATH . 'views/templates/header_alt.php';

        // navbar
            // <body>
            // <container>
            // <navbar></navbar>
        require APP_PATH . 'views/templates/navbar_alt.php';

        // content
            // <col-sm-12></end-col>
        require APP_PATH . 'views/templates/index/content.php';

        // footer 
            // <footer></footer>
            // </container>
            // </body>
            // </html>
        require APP_PATH . 'views/templates/footer.php';
    }
}