<html>
<head>
    <link rel="shortcut icon" type="image/x-icon" href="/public/img/AE-Logo.ico">
    <title> Transaction Fails </title>
<style type="text/css">
    body{
        font-family: "Open Sans",Arial,sans-serif;
    }
    @media print
    {    
        #goto_count, #btn-print *
        {
            display: none !important;
        }
    }
</style>

</head>
    <body>
        <div align="center">
            <div style="max-width: 100%; min-width: 500px; border: 2px solid #e3e3e3; border-radius:5px; margin-top: 20px">  
                <h3 class="alert alert-success">
                    {{ $message }}
                </h3>
                <h6>Please try again</h6>
                <div><a href="/">>> Go back</a></div>
        	</div>   
    	</div>
	</body>
</html>	
