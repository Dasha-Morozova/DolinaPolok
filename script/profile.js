function formatPhoneNumber(phoneNumber) {
    let cleaned = phoneNumber.replace(/\D/g, '');

    if (cleaned.length === 11) {
        //+7 (XXX) XXX-XX-XX
        return `+${cleaned[0]} (${cleaned.slice(1, 4)}) ${cleaned.slice(4, 7)}-${cleaned.slice(7, 9)}-${cleaned.slice(9)}`;
    } else {
        return phoneNumber;
    }
}

// Получаем элемент с номером телефона
const phoneElement = document.getElementById('phone');
const phoneNumber = phoneElement.textContent;

const formattedPhoneNumber = formatPhoneNumber(phoneNumber);
phoneElement.textContent = formattedPhoneNumber;
