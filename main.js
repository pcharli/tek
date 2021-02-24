let heart = document.querySelector(".fa-heart")
let stars = document.querySelectorAll('.fa-star')
let myInputs = document.querySelectorAll('.input, .textarea')
let inputListesAdd = document.querySelectorAll('.fa-plus-square')

heart.addEventListener('click', (e) => {
    e.preventDefault()
    let cible = e.target
        if( cible.classList.contains('far')) {
            document.querySelector(".input.like").value = 'oui'
        }
        else {
            document.querySelector(".input.like").value = 'non'
        }
        cible.classList.toggle("far")
        cible.classList.toggle("fas")
})

for(i=0; i<stars.length; i++) {
    let j = i
    stars[i].addEventListener("click", function(e)  {
        e.preventDefault()
        document.querySelectorAll(".stars .fas").forEach(el => {
            el.classList.remove("fas")
            el.classList.add("far")
        })
        document.querySelector(".input.stars").value = j+1
        for(k=0; k < j+1; k++) {
            stars[k].classList.add('fas')
        }
    })
}

for (let i=0; i < myInputs.length; i++) {
    myInputs[i].addEventListener("focus", function(e) {
        if(this.id == "total") {
           //alert('total')
            let preparationValue = (preparation.value != '') ? parseInt(preparation.value) : 0
            let reposValue = (repos.value != '') ? parseInt(repos.value) : 0
            let cuissonValue = (cuisson.value != '') ? parseInt(cuisson.value) : 0
            this.value = preparationValue + reposValue + cuissonValue
        }
        document.querySelector(`[for='${this.id}']`).classList.add('show')
    })
    myInputs[i].addEventListener("blur", function(e) {
        document.querySelector(`[for='${this.id}']`).classList.remove('show')
    })
}
//add d'une catégorie ou d'un mot clé
inputListesAdd.forEach(function(el) {
    //console.log(el)
    el.addEventListener("click", function(ev) {
        ev.preventDefault()
        let control = el.closest(".control")
        let field = control.querySelector(".input")
        let name = (field.id == "keywords") ? "tags[]" : "categories[]"
        let value = field.value
        if (value != "") {
            let template = `<li><input name="${name}" checked type="checkbox" class="liste-item" value="${value}">${value} <a href="" class="delete"></a></li>`
            control.querySelector(".liste").innerHTML += template
            field.value = ''
            field.focus()
            //suppression d'une catégorie ou d'un mot clé
            document.querySelectorAll('.delete').forEach(function(el) {
                //console.log(el)
                el.addEventListener("click", function (ev) {
                    ev.preventDefault()
                    el.closest("li").remove()
                })
            })
        }
        
    })
})

if(document.querySelectorAll('.delete')) {
document.querySelectorAll('.delete').forEach(function(el) {
    //console.log(el)
    el.addEventListener("click", function (ev) {
        ev.preventDefault()
        el.closest("li").remove()
    })
})
}
