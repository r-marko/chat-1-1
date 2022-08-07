
<div class="container row">
<div class="col-5 mt-4">
    <section style="background-color: #eee;" class="col-md-12 col-lg-11 col-xl-9 p-2">
        <h2>Available comrades:</h2>
        <?php 
        foreach($users as $user){
            if(count($users)>1){
            // delete login user from chat row
            if(isset($_SESSION['username']) && !empty($_SESSION['username'])){
                if ($user['username'] == $_SESSION['username']){
                    continue;
                }} ?>

                <div class="justify-content-start p-2 row">
                    <h4 class="col-4"><?php echo $user['username'] . "<br>"?></h4>
                    <span class="col-2 <?php 
                    if($user['status'] == true){
                        echo " badge-success";
                    } else if($user['status'] == false){
                        echo " badge-danger";
                    } else {
                        echo " badge-warning";
                    }?>"><?php 
                    if($user['status'] == true){
                        echo "online";
                        } else if($user['status'] == false){
                            echo "offline";
                        } else {
                            echo "unable";
                        }
                    ?>
                    </span>
                    <form class="col-5 form-post-user-id" method="POST" onsubmit="sendUserId(e)">
                    <button class="btn btn-primary button-send-id" type="submit" name="user-id" value="<?php echo $user['id'];  ?>">Start chat</button>
                    </form>
                </div>
        <?php }  else {echo "You are the only user of this chat!";} }?>
    </section>
</div>
                        <!-- END SECTION -->
<!------------------------------------------------------------------------------------->
    

<div class="col-7 row mt-4">
    <section style="background-color: #eee;">
        <div class="container py-5">

            <div class="row d-flex justify-content-center">
                <div class="col-md-10 col-lg-9 col-xl-7">

                    <div class="card" id="chat1" style="border-radius: 15px;">
                        <?php if(isset($_SESSION['chat_receiver_name']) && !empty($_SESSION['chat_receiver_name'])){ ?>
                        <div id="chat-ajax"> <!-- START AJAX -->

                        </div>  <!-- END AJAX -->  
                        <div class="form-outline">
                            <form id="chat-form">
                                <textarea class="form-control" id="textAreaExample" rows="4"></textarea>
                                <label class="form-label m-1" for="textAreaExample">Type your message</label>
                                <button type="submit" class="btn btn-primary m-2" name="chat-submit" id="chat-submit">Send</button>
                            </form>
                        </div>
                        <?php } else {echo "Choose chat person!";} ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
</div>

