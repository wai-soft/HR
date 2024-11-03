
function toggleSubmenu(id) {
    var submenu = document.getElementById(id);
    if (submenu.style.display === "block") {
        submenu.style.display = "none";
    } else {
        submenu.style.display = "block";
    }
}

function addDetail() {
    var detailsContainer = document.getElementById('detailsContainer');
    var detailDiv = document.createElement('div');
    detailDiv.className = 'detail';
    detailDiv.innerHTML = `
        <label for="description">Description:</label>
        <input type="text" name="details[][description]" required><br><br>
        <label for="amount">Amount:</label>
        <input type="number" name="details[][amount]" step="0.01" required><br><br>
        <label for="type">Type:</label>
        <select name="details[][type]" required>
            <option value="allowance">Allowance</option>
            <option value="deduction">Deduction</option>
        </select><br><br>
    `;
    detailsContainer.appendChild(detailDiv);
}
