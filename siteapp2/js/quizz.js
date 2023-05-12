window.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const resultDiv = document.querySelector('.result');
  
    form.addEventListener('submit', function(event) {
      event.preventDefault();
  
      const questions = document.querySelectorAll('h2[data-correct-answer]');
  
      questions.forEach(function(question) {
        const answer = question.getAttribute('data-correct-answer');
        const radios = question.parentNode.querySelectorAll('input[type="radio"]');
        const labels = question.parentNode.querySelectorAll('label');
  
        radios.forEach(function(radio, index) {
          const label = labels[index];
  
          if (radio.checked && radio.value === answer) {
            // Réponse correcte sélectionnée
            label.classList.add('correct');
            label.classList.remove('incorrect');
          } else if (radio.checked && radio.value !== answer) {
            // Réponse incorrecte sélectionnée
            label.classList.remove('correct');
            label.classList.add('incorrect');
          } else if (!document.querySelector(`input[name="${question.getAttribute('name')}"]:checked`)) {
            // Aucune réponse sélectionnée
            if (radios[index].value === answer) {
              label.classList.add('correct');
              label.classList.remove('incorrect');
            } else {
              label.classList.remove('correct');
              label.classList.remove('incorrect');
            }
          } else {
            label.classList.remove('correct');
            label.classList.remove('incorrect');
          }
        });
      });
  
      resultDiv.textContent = '';
    });
  });
  