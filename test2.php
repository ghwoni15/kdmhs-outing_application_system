<!DOCTYPE html>
<html>
<head>
    <title>TEST</title>
</head>
<body>
<p id="result">여기라규</p>
<input type="button" id="execute" value="execute" />
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script>
    document.querySelector('input').addEventListener('click', function(event){
        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'http://api.dimigo.hs.kr/v1/users/?fields=password_hash');
        xhr.onreadystatechange = function(){
            if(xhr.readyState === 4 && xhr.status === 200){
                document.querySelector('#time').innerHTML = xhr.responseText;
            }
        }
        xhr.send();
    });
</script>
</body>
</html>
