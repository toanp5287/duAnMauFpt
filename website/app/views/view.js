alert('JS OK');

const qtyInput = document.querySelector('.checkoutCount');
const qtyHidden = document.getElementById('soLuongHidden');
const couponSelect = document.getElementById('couponSelect');

const discountEl = document.getElementById('discount');
const finalTotalEl = document.getElementById('finalTotal');

const price = <?php echo (int)$list_sp['gia']; ?>;

function updatePrice() {

    let qty = parseInt(qtyInput ? qtyInput.value : 1);

    if (isNaN(qty) || qty < 1) qty = 1;

    if (qtyHidden) qtyHidden.value = qty;

    let total = price * qty;

    let giamGia = 0;

    if (couponSelect && couponSelect.value !== "") {

        const option = couponSelect.options[couponSelect.selectedIndex];

        const value = Number(option.dataset.value || 0);
        const type = option.dataset.type;

        if (type === 'percent') {
            giamGia = total * value / 100;
        } else {
            giamGia = value;
        }
    }

    const tongSauGiam = total - giamGia;

    // discount
    if (discountEl) {
        discountEl.textContent =
            giamGia.toLocaleString('vi-VN') + ' ₫';
    }

    // total
    if (finalTotalEl) {
        finalTotalEl.textContent =
            tongSauGiam.toLocaleString('vi-VN') + ' ₫';
    }
}

// EVENTS
if (qtyInput) {
    qtyInput.addEventListener('input', updatePrice);

    qtyInput.addEventListener('change', function () {
        if (this.value === "" || parseInt(this.value) < 1) {
            this.value = 1;
        }
        updatePrice();
    });
}

if (couponSelect) {
    couponSelect.addEventListener('change', updatePrice);
}

// INIT
updatePrice();


/// slivshow
 
