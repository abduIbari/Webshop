const exchangeRates = {
  EUR: 1,
  USD: 1.08,
  GBP: 0.86
};

const symbolToCode = {
  '€': 'EUR',
  '$': 'USD',
  '£': 'GBP'
};

function toggleDropdown() {
  const dropdown = document.getElementById("currencyDropdown");
  dropdown.classList.toggle("show");
}

function calculateConversion(element, newCurrencyCode) {
  const elementText = element.textContent;

  const currentCurrencyPrice = parseFloat(elementText.replace(/[^0-9.]/g, ''));
  const currentCurrencySymbol = elementText.match(/[€$£]/)[0];
  const currentCurrencyCode = symbolToCode[currentCurrencySymbol];

  let newCurrencyPrice = (exchangeRates[newCurrencyCode] * currentCurrencyPrice) / exchangeRates[currentCurrencyCode];
  let newCurrencySymbol = Object.keys(symbolToCode).find(symbol => symbolToCode[symbol] === newCurrencyCode)

  if (elementText.includes("Price with tax:")) {
    element.textContent = `Price with tax: ${newCurrencySymbol}${newCurrencyPrice.toFixed(2)}`;
  } else {
    element.textContent = `Price: ${newCurrencySymbol}${newCurrencyPrice.toFixed(2)}`;
  }
}

function updateCurrency(productId, newCurrencyCode) {
  const productElement = document.getElementById(productId);
  const taxElements = document.querySelectorAll(".taxPara");

  calculateConversion(productElement, newCurrencyCode)

  taxElements.forEach((taxElement) => {
    calculateConversion(taxElement, newCurrencyCode)
  })
}

document.getElementById("currencyBtn").addEventListener("click", toggleDropdown);

document.querySelectorAll(".dropdown-content a").forEach(option => {
  option.addEventListener("click", (e) => {
    const newCurrencyCode = e.target.dataset.currency;

    // Get all price elements and update each one
    const priceElements = document.querySelectorAll('[id$="Price"]');
    priceElements.forEach(element => {
      updateCurrency(element.id, newCurrencyCode);
    });
    toggleDropdown();
  });
});