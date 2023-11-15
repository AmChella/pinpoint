<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        /* Style for labels */
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        /* Style for input elements */
        div input {
            width: 70%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Style for datalist */
        div datalist {
            display: none; /* Hide datalist by default */
        }

        /* Style for input[type="text"] */
        div input[type="text"] {
            width: 70%;
        }

        /* Style for input[type="datetime-local"] */
        div input[type="datetime-local"] {
            width: calc(70% - 2px); /* Adjust width to account for border */
        }

        /* Style for input list */
        div input[list] {
            width: 70%;
        }

        /* Style for div container */
        div {
            margin-bottom: 15px;
        }

        button {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }


    </style>
</head>
<body>
    <?php
        require_once  __DIR__ . "/vendor/autoload.php";

        use Amchella\Pinpoint\App;
        $app = new App();
        $uids = $app->getUids();
        echo '<form action="service.php" method="post"><div><label for="uid-1">Choose Uid</label><div><input list="uid" name="uid" id="uid-1" required="true"><datalist id="uid">';
        for($i = 0; $i < count($uids); $i++) {
            echo '<option value="' . $uids[$i] . '"/>';
        }
    ?>
    </datalist></div>
    <label for="start">Start Time </label>
    <div><input type="datetime-local" name="start" id="start" required="true"/></div>
    <label for="end">End Time</label>
    <div><input type="datetime-local" name="end" id="end" required="true"/></div>
    <label for="type">Session Type</label>
    <div><input list="browsers" name="browser" id="type" required="true">
    <datalist id="browsers">
    <option value="Creation">
    <option value="Cancel">
    </datalist></div>
    <label for="summary">Summary</label>
    <div><input type="text" name="summary" id="summary" required="true"/></div>
    <label for="description">Description</label>
    <div><input type="text" name="description" id="description" required="true"/></div>
    <label for="status-1">Status</label>
    <div><input list="status" name="status" id="status-1" required="true">
    <datalist id="status">
    <option value="CANCELLED">
    <option value="CONFIRMED">
    </datalist></div>
    <button>Submit</button>
    </form>
</div>
</body>
</html>