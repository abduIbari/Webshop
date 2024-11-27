const addM1Button = document.getElementById("addM1")
const addM2Button = document.getElementById("addM2")
const add15ProButton = document.getElementById("add15Pro")
const add16ProButton = document.getElementById("add16Pro")
const addHpButton = document.getElementById("addHp")
const addS24Button = document.getElementById("addS24")


if (addM1Button) {
  addM1Button.addEventListener("click", () => {
    const productPrice = document.getElementById("m1Price").textContent
    addItem("Macbook Air M1", productPrice)
  })
}

if (addM2Button) {
  addM2Button.addEventListener("click", () => {
    const productPrice = document.getElementById("m2Price").textContent
    addItem("Macbook Air M2", productPrice)
  })
}

if (add15ProButton) {
  add15ProButton.addEventListener("click", () => {
    const productPrice = document.getElementById("15proPrice").textContent
    addItem("IPhone15 Pro", productPrice)
  })
}

if (add16ProButton) {
  add16ProButton.addEventListener("click", () => {
    const productPrice = document.getElementById("16proPrice").textContent
    addItem("IPhone16 Pro", productPrice)
  })
}

if (addHpButton) {
  addHpButton.addEventListener("click", () => {
    const productPrice = document.getElementById("hpPrice").textContent
    addItem("HP Envy Laptop", productPrice)
  })
}

if (addS24Button) {
  addS24Button.addEventListener("click", () => {
    const productPrice = document.getElementById("s24Price").textContent
    addItem("Samsung Galaxy S24 Ultra", productPrice)
  })
}

let collection = [];

function displayCollection() {
  const collectionList = document.getElementById('collectionItems');
  collectionList.innerHTML = '';

  const itemCount = {}

  // this counts occurences of the item
  collection.forEach(item => itemCount[item.name] = (itemCount[item.name] || 0) + 1)

  Object.keys(itemCount).forEach((name) => {
    const listItem = document.createElement('li');

    const textSpan = document.createElement('span');
    textSpan.textContent = `${name}  |  Quantity = `;

    const quantityInput = document.createElement('input');
    quantityInput.type = 'number';
    quantityInput.value = itemCount[name];
    quantityInput.min = 1;
    quantityInput.classList.add("quantityInput")
    quantityInput.addEventListener('change', () => {
      updateQuantity(name, parseInt(quantityInput.value));
    });

    textSpan.appendChild(quantityInput);
    listItem.appendChild(textSpan);

    const removeButton = document.createElement('button');
    removeButton.textContent = 'Remove';
    removeButton.classList.add("auth-button")
    removeButton.onclick = () => removeItem(name);

    listItem.appendChild(removeButton);
    collectionList.appendChild(listItem);
  });
}

function addItem(name) {
  collection.push({ name: name });
  displayCollection();
  console.log(collection)
}

function removeItem(name) {
  const index = collection.findIndex(item => item.name === name);

  if (index !== -1) {
    collection.splice(index, 1);
  }

  displayCollection();
  console.log(collection);
}

function updateQuantity(name, newQuantity) {
  // counts products with the same name
  let count = 0;
  collection.forEach(item => {
    if (item.name === name) {
      count++;
    }
  });

  if (count > 0) {
    const difference = newQuantity - count;
    // if positive difference we add products to our collection
    if (difference > 0) {
      for (let i = 0; i < difference; i++) {
        addItem(name);
      }
    }
    // if negative difference we remove products to our collection
    else if (difference < 0) {
      for (let i = 0; i < Math.abs(difference); i++) {
        removeItem(name)
      }
    }
    displayCollection();
    console.log(collection);
  }
}

displayCollection();

