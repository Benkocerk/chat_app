<?php
include 'config.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message'])) {
    $message = $_POST['message'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO messages (user_id, message) VALUES (?, ?)");
    $stmt->bind_param("is", $user_id, $message);
    $stmt->execute();
    $stmt->close();
}

$messages = $conn->query("SELECT users.username, messages.message, messages.timestamp FROM messages JOIN users ON messages.user_id = users.id ORDER BY messages.timestamp DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Chat</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <?php if ($_SESSION['is_admin']): ?>
        <a href="admin.php">Admin Panel</a>
    <?php endif; ?>
    <form method="POST" action="chat.php">
        <textarea name="message" placeholder="Enter your message" required></textarea>
        <button type="submit">Send</button>
    </form>
    <form method="POST" action="logout.php">
        <button type="submit">Logout</button>
    </form>
    <div id="chatbox">
        <?php while ($row = $messages->fetch_assoc()): ?>
            <div>
                <strong><?php echo $row['username']; ?>:</strong>
                <span><?php echo $row['message']; ?></span>
                <em><?php echo $row['timestamp']; ?></em>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>