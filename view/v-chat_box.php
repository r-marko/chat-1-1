<div class="card-header d-flex justify-content-between align-items-center p-3 bg-info text-white border-bottom-0" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
  <i class="fas fa-angle-left"></i>
  <p class="mb-0 fw-bold">Live chat</p>
  <i class="fas fa-times"></i>
</div>
<div class="card-body">
  <?php foreach($table_one_to_one as $value){ 
      if(isset($chat_sender_id)){
       // cilj je da ne moze poruka drugog ucesnka da se prikase, osim onoga koga smo selektovali da imamo prepisku
        if($chat_sender_id == $value['sender_id'] && $value['receiver_id'] == $chat_receiver_id){ ?>
  <div class="d-flex flex-row justify-content-start mb-4">
    <span> <?php
      if(isset($users)){
        foreach($users as $user){
          if($user['id'] == $chat_sender_id){
            echo htmlspecialchars($user['username']);
          }
        }
      } 
     ?></span>
     <small><?php echo htmlspecialchars($value['message_date']); ?></small>
    <div class="p-3 ms-3" style="border-radius: 15px; background-color: rgba(57, 192, 237,.2);  ">
      <p class="small mb-0"><?php echo htmlspecialchars($value['message']); ?></p>
    </div>
  </div>
        <?php }} ?>
        <?php 
      if(isset($chat_receiver_id)){ 
        // cilj je da ne moze poruka drugog ucesnka da se prikase, osim onoga koga smo selektovali da imamo prepisku
        if($chat_sender_id == $value['receiver_id'] && $value['sender_id'] == $chat_receiver_id){ ?>
  <div class="d-flex flex-row justify-content-end mb-4">
    <div class="p-3 me-3 border" style="border-radius: 15px; background-color: #fbfbfb;">
      <p class="small mb-0"><?php echo htmlspecialchars($value['message']); ?></p>
    </div>
    <span> <?php
      if(isset($users)){
        foreach($users as $user){
          if($user['id'] == $chat_receiver_id){
            echo htmlspecialchars($user['username']);
          }
        }
      } ?>

    </span>
    <small><?php echo htmlspecialchars($value['message_date']); ?></small>
  </div>
  <?php }}}  ?>
</div>  