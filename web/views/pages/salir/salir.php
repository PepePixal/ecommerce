<?php

//Destroys all data registered to a session
session_destroy();

//redireccionar a la página /admin
echo '<script>
    window.location = "/admin";
</script>'

?>