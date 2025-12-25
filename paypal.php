
<div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <h1>TravianProX Gold Packages</h1>
		  <h2>Choose package here:</h2>
		  <h2>🡳🡳🡳🡳🡳🡳🡳🡳🡳</h2>
          <select id="item-options"><option value="Package A" price="2.49">Package A - 2.49 EUR</option><option value="Package B" price="4.99">Package B - 4.99 EUR</option><option value="Package C" price="9.99">Package C - 9.99 EUR</option><option value="Package D" price="24.99">Package D - 24.99 EUR</option><option value="Package E" price="49.99">Package E - 49.99 EUR</option><option value="Package F" price="99.99">Package F - 99.99 EUR</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
		  <h2>🡱🡱🡱🡱🡱🡱🡱🡱🡱</h2>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=AVrOndvwR57foCjUrqqp_ZEYuXLSs8j15r10G_QYdD0s39OwxaOhhKbKRnAqZXCNBxomLFGkb6WaKQqB&currency=EUR" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        var shipping = 0;
        var itemOptions = document.querySelector("#smart-button-container #item-options");
    var quantity = parseInt();
    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
    if (!isNaN(quantity)) {
      quantitySelect.style.visibility = "visible";
    }
    var orderDescription = 'TravianProX Gold Packages';
    if(orderDescription === '') {
      orderDescription = 'Item';
    }
    paypal.Buttons({
      style: {
        shape: 'pill',
        color: 'blue',
        layout: 'vertical',
        label: 'buynow',
        
      },
      createOrder: function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (20 === 0) ? 0 : (selectedItemPrice * (parseFloat(20)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'EUR',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'EUR',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'EUR',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'EUR',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'EUR',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          alert('Transaction completed by ' + details.payer.name.given_name + '!');
        });
      },
      onError: function(err) {
        console.log(err);
      },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
