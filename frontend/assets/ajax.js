async function carregaDados(){
    let box = document.getElementById('dados');
    await fetch( new Request('dados.php'))
    .then(
        function (response){
             response.text().then(
                function (data){
                    box.innerHTML = data;
                }
            );
        }
    )
    .catch(
        function (error){
            console.log(error);
        }
    )
}