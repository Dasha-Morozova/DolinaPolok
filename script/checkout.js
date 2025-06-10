function updateTotalSum() {
    let totalSum = document.getElementById('total-sum').textContent;
    document.getElementById('total-sum').textContent = totalSum.toFixed(2);
};
updateTotalSum();