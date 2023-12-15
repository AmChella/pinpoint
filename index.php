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
            width: 30%;
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
            width: 30%;
        }

        /* Style for input[type="datetime-local"] */
        div input[type="datetime-local"] {
            width: calc(70% - 2px); /* Adjust width to account for border */
        }

        /* Style for input list */
        div input[list] {
            width: 30%;
        }

        /* Style for div container */
        div {
            margin-bottom: 15px;
        }

        button.create {
            padding: 10px 15px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.create:hover {
            background-color: #86bd89;
        }

        button.cancel {
            padding: 10px 15px;
            background-color: #eb4034;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.cancel:hover {
            background-color: #e6817a;
        }

        .hide {
            display:none
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #2196F3;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
</head>
<body>
    <label for="dash">Single Event</label>
    <label class="switch">
        <input id="dash" type="checkbox" checked>
        <span class="slider round"></span>
    </label>
        <form action="service.php" name="event">
              <h2>Single event</h2>
            <div>
                <label for="starttime">Start (date and time):</label>
                <input type="datetime-local" id="starttime" name="starttime" required=true>
            </div>
            <div>
                <label for="endtime">End (date and time):</label>
                <input type="datetime-local" id="endtime" name="endtime" required=true>
            </div>
            <div>
                <label for="uid">Unique Identifier:</label>
                <input name="uid" id="uid" type="text" required=true/>
            </div>
            <div>
                <label for="org">Organizer Email:</label>
                <input name="org" id="org" type="email" required=true/>
            </div>
            <div>
                <button class="create" name="type" value="create">Create</button>
                <button class="cancel" name="type" value="cancel">Cancel</button>
            </div>
        </form>
        <form action="repeat.php" name="event" class="hide">
        <h2>Recurring Event</h2>
            <div>
                <label for="ftype">Choose frequency type:</label>
                <input list="ftypes" name="ftype" id="ftype" required=true>
                <datalist id="ftypes">
                    <option value="daily">
                </datalist>
            </div>
            <div>
                <label for="rstarttime">Start (date and time):</label>
                <input type="datetime-local" id="rstarttime" name="starttime" required=true>
            </div>
            <div>
                <label for="rendtime">End (date and time):</label>
                <input type="datetime-local" id="rendtime" name="endtime" required=true>
            </div>
            <div>
                <label for="org">Organizer Email:</label>
                <input name="org" id="org" type="email" required=true/>
            </div>
            <div>
                <label for="uid">Unique Identifier:</label>
                <input name="uid" id="uid" type="text" required=true/>
            </div>
            <div>

                <button class="create" name="type" value="create">Create</button>
                <button class="cancel" name="type" value="cancel">Cancel</button>
            </div>
        </form>
</div>
</body>
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        let rstart = document.getElementById('rstarttime');
        let rend = document.getElementById('rendtime');
        let start = document.getElementById('starttime');
        let end = document.getElementById('endtime');
        let slider = document.querySelector(".switch input");
        let forms = document.querySelectorAll("form");

        slider.addEventListener('click', () => {
            forms.forEach((e) => {
                e.classList.toggle('hide');
            });
        });

        start.addEventListener('change', function() {
            if (start.value)
                end.min = start.value;
        }, false);
        end.addEventLiseter('change', function() {
            if (end.value)
                start.max = end.value;
        }, false);

        rstart.addEventListener('change', function() {
            if (rstart.value)
                rend.min = rstart.value;
        }, false);
        rend.addEventLiseter('change', function() {
            if (rend.value)
                rstart.max = rend.value;
        }, false);
    });
</script>
</html>