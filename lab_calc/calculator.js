const input = document.querySelector('.input');
const result = document.querySelector('.result');

const operators = ['+', '-', '*', '÷'];

const buttons = document.querySelectorAll('.switchs button');
buttons.forEach(button => {
  button.addEventListener('click', () => {
    const value = button.innerHTML;

    if (value === 'C') {
      input.value = '';
      result.innerHTML = 'Результат:';
    } else if (value === '=') {
      let expression = input.value;
      expression = expression.replace(/÷/g, '/');
      expression = expression.replace(/x/g, '*');

      let answer = eval(expression);

      if (answer === Infinity || isNaN(answer)) {
        result.innerHTML = 'Ошибка: деление на 0';
      } else {
        result.innerHTML = `Результат: ${answer}`;
      }
    } else if (operators.includes(value)) {
      input.value += value;
    } else {
      input.value += value;
    }
  });
});
