(function(){
  function ready(fn){ if(document.readyState!=='loading'){ fn(); } else { document.addEventListener('DOMContentLoaded', fn); } }
  ready(function(){
    // Animate payment card selection
    document.querySelectorAll('[data-pay-card]').forEach(function(card){
      card.addEventListener('click', function(){
        document.querySelectorAll('[data-pay-card]').forEach(function(c){ c.classList.remove('selected'); });
        card.classList.add('selected');
        var input = card.querySelector('input[type="radio"]');
        if(input && !input.disabled){ input.checked = true; }
      });
    });

    // Prevent double-submit + show spinner
    var form = document.getElementById('checkoutForm');
    var button = document.getElementById('placeOrderBtn');
    var spinner = document.getElementById('orderSpinner');
    if(form && button){
      form.addEventListener('submit', function(){
        if(button){ button.disabled = true; }
        if(spinner){ spinner.style.display = 'block'; }
      });
    }
  });
})();
