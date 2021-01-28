window.onload = function() {
    displayOptionsInterest();
    fetch('../../backend/get-members.php')
        .then(response => response.json())
        .then(data => {
            //console.log(data);
            displayMembers(data);
        })
}
function searchMembers() {
    document.querySelector('#search-member').addEventListener('submit', function(ev) {
        ev.preventDefault();
        let search = document.getElementById('search').value;
        fetch('../../backend/search-members.php?search=' + search)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                displayMembers(data);
            })
    });
    
}

function searchInterest() {
    document.querySelector('#search-interest').addEventListener('submit', function(ev) {
        ev.preventDefault();
        let search = document.getElementById('interest').value;
        fetch('../../backend/search-interest.php?search=' + search)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                displayMembers(data);
            })
    });
}

function displayOptionsInterest() {
    let selectElt = document.getElementById('interest');
    selectElt.innerText = "";
    fetch('../../backend/get-interests.php', {
        headers : { 
          'Content-Type': 'application/json',
          'Accept': 'application/json'
         }
  
      })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            let selectElt = document.getElementById('interest');
            for (let i = 0 ; i < data.length ; i++) {
                let optionElt = document.createElement('option');
                optionElt.value = data[i].interet_id;
                optionElt.innerText = data[i].nom;
                selectElt.appendChild(optionElt);
            }
            
        })
}

function displayMembers(data) {
    let membersElt = document.getElementById('members');
    membersElt.innerText = "";
            for (let i=0; i < data.length; i++) {
                let cardElt = document.createElement('div');
                let divElt = document.createElement('div');
                let imgElt = document.createElement('img');
                if (data[i].photo !== null) {
                    imgElt.src = data[i].photo;
                    divElt.classList.add('has-profile');
                } else {
                    imgElt.src = 'https://via.placeholder.com/150';
                    divElt.classList.add('no-profile');
                }
                imgElt.alt = 'avatar';
                divElt.appendChild(imgElt);

                let infoElt = document.createElement('div');
                infoElt.classList.add('info', 'ml');
                let pseudoElt = document.createElement('span');
                pseudoElt.innerText = data[i].pseudo;
                let fullnameElt = document.createElement('span');
                fullnameElt.innerText = data[i].prenom + " " + data[i].nom;
                infoElt.appendChild(pseudoElt);
                infoElt.appendChild(fullnameElt);
                divElt.appendChild(infoElt);
                let dateElt = document.createElement('span');
                dateElt.classList.add('ml');
                dateElt.innerHTML = "Membre depuis :<br/>" + data[i].date_adhesion;
                divElt.appendChild(dateElt);
                cardElt.appendChild(divElt);
                // si on a rempli le profil, le profil est consultable par clic sur la card
                if (data[i].photo !== null) {
                    
                    let linkElt = document.createElement('a');
                    linkElt.href = '../frontend/profile.php?id=' + data[i].adherent_id;
                    linkElt.appendChild(cardElt) ;
                    membersElt.appendChild(linkElt);
                } else {
                    membersElt.appendChild(cardElt);
                }

                
            }
}