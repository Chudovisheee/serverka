let display = document.getElementById('display');
let form = document.getElementById('calculatorForm');

// Добавление символа в поле ввода
function addToDisplay(value) {
    display.value += value;
}

// Очистка поля
function clearDisplay() {
    display.value = '';
}

// Удаление последнего символа
function backspace() {
    display.value = display.value.slice(0, -1);
}

// Вычисление результата
function calculate() {
    let expression = display.value;
    
    if (!expression) {
        alert('Введите выражение');
        return;
    }
    
    document.getElementById('calculatorForm').submit();
}

// Добавление функций и констант
function addFunction(fnName) {
    switch(fnName) {
        case 'pi':
            display.value += 'π';
            break;
        case 'e':
            display.value += 'e';
            break;
        case 'sqrt':
            display.value += '√(';
            break;
        case 'ln':
            display.value += 'ln(';
            break;
        case 'log':
            display.value += 'log(';
            break;
        case 'fact':
            display.value += 'fact(';
            break;
        case 'pow2':
            display.value += '^2';
            break;
        case 'pow3':
            display.value += '^3';
            break;
        case 'powx':
            display.value += '^';
            break;
        case 'neg':
            if (display.value === '' || display.value.match(/[+\-*/^]$/)) {
                display.value += '-';
            } else {
                let match = display.value.match(/(\d+(?:\.\d+)?)$/);
                if (match) {
                    let pos = match.index;
                    display.value = display.value.slice(0, pos) + '-(' + match[0] + ')';
                }
            }
            break;
    }
}

// Обработка нажатий на кнопки
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Константы π и e
        if (btn.classList.contains('memory')) {
            let val = btn.getAttribute('data-value');
            if (val === 'pi') addFunction('pi');
            else if (val === 'e') addFunction('e');
        }
        // Обычные символы
        else if (btn.classList.contains('num') || btn.hasAttribute('data-char')) {
            let char = btn.getAttribute('data-char');
            if (char) addToDisplay(char);
        } 
        // Функции
        else if (btn.classList.contains('fn')) {
            let fn = btn.getAttribute('data-fn');
            if (fn) addFunction(fn);
        } 
        // Очистка
        else if (btn.id === 'clear') {
            clearDisplay();
        } 
        // Равно
        else if (btn.id === 'equals') {
            calculate();
        } 
        // Backspace
        else if (btn.id === 'backspace') {
            backspace();
        }
    });
});

// Поддержка клавиатуры
document.addEventListener('keydown', (e) => {
    const key = e.key;
    
    if (/[\d.]/.test(key)) {
        e.preventDefault();
        addToDisplay(key);
    }
    else if (key === '+' || key === '-' || key === '*' || key === '/') {
        e.preventDefault();
        addToDisplay(key);
    }
    else if (key === '^') {
        e.preventDefault();
        addToDisplay('^');
    }
    else if (key === '(' || key === ')') {
        e.preventDefault();
        addToDisplay(key);
    }
    else if (key === 'Enter') {
        e.preventDefault();
        calculate();
    }
    else if (key === 'Backspace') {
        e.preventDefault();
        backspace();
    }
    else if (key === 'Escape') {
        e.preventDefault();
        clearDisplay();
    }
    else if (key === 'p' || key === 'P') {
        e.preventDefault();
        addFunction('pi');
    }
    else if (key === 'e') {
        e.preventDefault();
        addFunction('e');
    }
    else if (key === 's' || key === 'S') {
        e.preventDefault();
        addFunction('sqrt');
    }
    else if (key === 'l' || key === 'L') {
        e.preventDefault();
        addFunction('ln');
    }
    else if (key === 'g' || key === 'G') {
        e.preventDefault();
        addFunction('log');
    }
    else if (key === 'f' || key === 'F') {
        e.preventDefault();
        addFunction('fact');
    }
});