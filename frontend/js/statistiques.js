function getAvg() {
    fetch('../../backend/get-avg.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let avgElt = document.getElementById('avg-interest');
            avgElt.innerText = data;
        })
}

function getNbInterest() {
    fetch('../../backend/get-nb-interest.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let nbElt = document.getElementById('nb-interest');
            let ulElt = document.createElement('ul');
            for (let i = 0 ; i < data.length ; i++) {
                if (data[i].nom !== "") {
                    let liElt = document.createElement('li');
                    liElt.innerText = data[i].nom + " : " + data[i].nb_adherent;
                    ulElt.appendChild(liElt);
                    console.log(liElt);
                }
            }
            nbElt.appendChild(ulElt);
            
        })
}
getAvg();
getNbInterest();