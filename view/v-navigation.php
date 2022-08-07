<div class="container" id="nav-container">
    <nav class="nav justify-content-center">
        <h4 class="nav-link">Hello <?php if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {echo " " .$_SESSION['username'] . ", ";} ?></h4>
        <h4 class="nav-link" id="chat-mate">
            <?php
            if (isset($_SESSION['chat_receiver_name']) && !empty($_SESSION['chat_receiver_name'])){
                    echo "you are chating with " . $_SESSION['chat_receiver_name'];
            } else {
            echo "choose your chat mate";
            }
            ?>
            </h4>
            <form method="POST" action="chat.php">
                <button type="submit" name="chat-exit" value="exit" class="btn btn-secondary">Exit</button>
            </form>
        <h4 class="nav-link">Chat groups</h4>
        <form method="POST" action="chat.php">
            <button type="submit" name="log-out" value="logout" class="btn btn-danger">Log out</button>
        </form>
    </nav>
</div>
