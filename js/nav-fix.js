(function(){
  function ready(fn){ if(document.readyState!=='loading'){ fn(); } else { document.addEventListener('DOMContentLoaded', fn); } }
  ready(function(){
    var togglers = document.querySelectorAll('.modern-header .navbar-toggler');
    togglers.forEach(function(btn){
      btn.addEventListener('click', function(e){
        var targetSel = btn.getAttribute('data-target') || btn.getAttribute('data-bs-target');
        if(!targetSel) return;
        var target = document.querySelector(targetSel);
        if(!target) return;
        // Toggle 'show' class
        if(target.classList.contains('show')){
          target.classList.remove('show');
          btn.setAttribute('aria-expanded','false');
        } else {
          target.classList.add('show');
          btn.setAttribute('aria-expanded','true');
        }
      });
    });
  });
})();
