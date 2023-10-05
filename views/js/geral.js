$("#valor").maskMoney({thousands:'', decimal:'.'});

function compareDates (date) {
    let replace = date.replaceAll('-', '/')
    let parts = replace.split('/')
    let join = `${parts[2]},${parts[1]},${parts[0]}`
    let vencimento = join.replaceAll(',', '/')
    let today = new Date().toLocaleString().substr(0, 10) // pega a data atual

    // compara se a data informada é maior que a data atual
    // e retorna true ou false
    if (vencimento < today)
        return valor - (valor * (5/100))
    else if (vencimento > today)
        return valor + (valor * (10/100))
    if (vencimento === today)
        return valor;
}

let vencimento = document.querySelector("#vencimento").value
let valor = parseFloat(document.querySelector("#valor").value)
let result = parseFloat(compareDates(vencimento, valor)).toFixed(2) // Retorna false

document.getElementById("pagamento").value = result;