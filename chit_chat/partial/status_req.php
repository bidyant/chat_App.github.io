<?php
if(isset($_SESSION['id']))
{
echo '
<script>
function set_status()
{
    const sts = new XMLHttpRequest();
    sts.open("POST", "api.php", true);
    sts.onload = () => {
        if (sts.readyState === XMLHttpRequest.DONE) {
            if (sts.status === 200) {
                console.log(sts.response);
            } else {
                console.log("problem occured");
            }
        }
    };
    let data = {
        "data_type": "set_status",
        "id":'.$_SESSION['id'].'
    };
    let mydata = JSON.stringify(data);
    sts.send(mydata);
}
set_status();
    setInterval(() => {
     set_status();   
    }, 20000);
</script>';
}
?>