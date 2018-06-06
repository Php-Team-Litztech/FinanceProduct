<html>
<head>
    <script type='text/javascript'>
        function addFields(){
            // Number of inputs to create
            var number = document.getElementById("member").value;
            // Container <div> where dynamic content will be placed
            var container = document.getElementById("container");
            // Clear previous contents of the container
            while (container.hasChildNodes()) {
                container.removeChild(container.lastChild);
            }
            for (i=0;i<number;i++){
                // Append a node with a random text
                container.appendChild(document.createElement("<div class='form-group'>");
                container.appendChild(document.createTextNode("Due Date " + (i+1)));
                // Create an <input> element, set its type and name attributes
                var input = document.createElement("input");
                input.class = "class-contr"
                input.type = "text";
                input.name = "text_" + i;
                input.id = "text_" + i;
                container.appendChild(input);
                // Append a line break 
                container.appendChild(document.createElement("</div>"));
            }
        }
    </script>
</head>
<body>
	
    <input type="text" id="member" name="member" value="">Number of members: (max. 10)<br />




    <a href="#" id="filldetails" onclick="addFields()">Fill Details</a>
    <div id="container"/>
    <div class='form-group' id="container" />
</body>
</html>



<label> $i Due Date </label>
<input class='form-control' type='number' name='text_$i' id=text_$i required />
</div>