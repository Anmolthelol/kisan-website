
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script src="../include/js/bootstrap4/bootstrap.min.js"></script>
<!-- <script src=../include/js/jquery.min.js"></script> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.14.0/js/mdb.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="https://js.pusher.com/5.1/pusher.min.js"></script>

<script>
    const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: true,
    })
    var pusher = new Pusher('7e8468813b5c9a27343c', {
        cluster: 'ap2',
        forceTLS: true
    });
    var channel = pusher.subscribe('admin-channel');
    channel.bind('admin-event', function(data) {
        $.ajax({
            type: "POST",
            url: "php/notification.php",
            dataType: "html",
            data:{
            //id:data['id'],
            msg:data['message']
            }, 
            success: function (response) {
            if(response == "1"){
                
                $.ajax({
                type: "POST",
                url: "php/notification.php",
                dataType: "html",
                success: function (response) {
                        $("#notification-dropdown").html(response);
                    }
                })
                Toast.fire({
                    icon: 'success',
                    title: data['message']
                })
                $(".swal2-styled").css('background-color', '#fff')
                $(".swal2-styled").css('color', '#333')
                $(".swal2-confirm").html('&#x2716;')


            }
            //  console.log(data);
            }
        });  
    });
</script>