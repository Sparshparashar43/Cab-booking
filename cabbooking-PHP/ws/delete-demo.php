<html>
        <script language="javascript">
            /* This function is invoked by the activity */
                function wave() {
                    alert("1");
                        document.getElementById("droid").src="android_waving.png";
                        alert("2");
                }
        </script>
        <body>
            <!-- Calls into the javascript interface for the activity -->
            <a onClick="window.demo.clickOnAndroid()"><div style="width:80px;
                        margin:0px auto;
                        padding:10px;
                        text-align:center;
                        border:2px solid #202020;" >
                                <img id="droid" src="android_normal.png"/><br>
                                Click me!
                </div></a>
        </body>
</html>