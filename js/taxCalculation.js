function getTotalPrice(priceWOTax) {
  const taxRate = 0.19;
  const priceWithTax = priceWOTax * (1 + taxRate);
  return priceWithTax.toFixed(2);
}

function addPriceWithTax(productId, priceWithTax) {
  const taxPara = document.getElementById(`${productId}WithTax`);
  if (taxPara) {
    taxPara.textContent = `Price with tax: €${priceWithTax}`;
  }
}

function getPriceWOTax(elementId) {
  return parseFloat(document.getElementById(elementId).textContent.replace("Price: €", ""));
}

function updatePrices() {
  const prices = {
    m1Price: "m1Price",
    m2Price: "m2Price",
    apple15Price: "15proPrice",
    apple16Price: "16proPrice",
    hpPrice: "hpPrice",
    samsungs24Price: "s24Price"
  };

  Object.values(prices).forEach((id) => {
    const element = document.getElementById(id);
    if (element) {
      const priceWOTax = getPriceWOTax(id);
      if (!isNaN(priceWOTax)) {
        const priceWithTax = getTotalPrice(priceWOTax);
        addPriceWithTax(id, priceWithTax);
      }
    }
  });

}

updatePrices()


