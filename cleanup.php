<?php 
    //! Post-Installation Cleanup
    array_map('unlink', glob("./install/*.*"));
    rmdir("./install/");
    header("Location: login.php?is=1");
?>