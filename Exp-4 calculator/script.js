// script.js
const display = document.getElementById("display");
let degreeMode = true;
let memory = 0;
let lastAns = 0;

// ---- Insert value ----
function insert(v) {
  if (display.value === "0" || display.value === "Error" || display.value === "Infinity") {
    display.value = v;
  } else {
    display.value += v;
  }
}

// ---- Clear ----
function clearDisplay() { display.value = "0"; }

// ---- Delete last ----
function deleteLast() {
  if (display.value.length <= 1 || display.value === "Error") {
    display.value = "0";
  } else {
    display.value = display.value.slice(0, -1);
  }
}

// ---- Evaluate ----
function calculate() {
  try {
    let expr = display.value;
    expr = expr.replace(/(\d+(\.\d+)?)%/g, "($1/100)");
    expr = expr.replace(/ANS/g, `(${lastAns})`);
    expr = expr.replace(/mod/g, '%');
    let result = Function('"use strict"; return (' + expr + ')')();
    if (!isFinite(result)) { display.value = "Error"; return; }
    lastAns = result;
    let str = Number(result.toFixed(12));
    if (str.toString().length > 16) display.value = result.toExponential(8);
    else display.value = str;
  } catch(e) { display.value = "Error"; }
}

// ---- Scientific functions ----
function scientific(type) {
  try {
    let num = parseFloat(display.value);
    if (isNaN(num)) { display.value = "Error"; return; }
    let result;
    const toRad = (x) => degreeMode ? x * Math.PI / 180 : x;
    switch(type) {
      case 'sin': result = Math.sin(toRad(num)); break;
      case 'cos': result = Math.cos(toRad(num)); break;
      case 'tan': result = Math.tan(toRad(num)); break;
      case 'sinh': result = Math.sinh(num); break;
      case 'cosh': result = Math.cosh(num); break;
      case 'tanh': result = Math.tanh(num); break;
      case 'log': result = num > 0 ? Math.log10(num) : NaN; break;
      case 'ln': result = num > 0 ? Math.log(num) : NaN; break;
      case 'sqrt': result = num >= 0 ? Math.sqrt(num) : NaN; break;
      case 'square': result = num * num; break;
      case 'inv': result = num !== 0 ? 1/num : NaN; break;
      case 'factorial': result = factorial(num); break;
      case 'nCr': {
        let n = parseInt(prompt("n (total):", "5"));
        let r = parseInt(prompt("r (choose):", "2"));
        result = (n>=r && n>=0 && r>=0) ? comb(n,r) : NaN;
        break;
      }
      case 'nPr': {
        let n2 = parseInt(prompt("n (total):", "5"));
        let r2 = parseInt(prompt("r (choose):", "2"));
        result = (n2>=r2 && n2>=0 && r2>=0) ? perm(n2,r2) : NaN;
        break;
      }
      default: return;
    }
    if (!isFinite(result) || isNaN(result)) { display.value = "Error"; return; }
    lastAns = result;
    let str = Number(result.toFixed(12));
    display.value = str.toString().length > 16 ? result.toExponential(8) : str;
  } catch(e) { display.value = "Error"; }
}

// ---- Factorial, combinations, permutations ----
function factorial(n) {
  if (n < 0 || !Number.isInteger(n) || n > 170) return NaN;
  if (n === 0 || n === 1) return 1;
  let r = 1;
  for (let i=2; i<=n; i++) r *= i;
  return r;
}
function comb(n,r) { 
  if (r < 0 || r > n) return NaN;
  return factorial(n) / (factorial(r) * factorial(n-r));
}
function perm(n,r) { 
  if (r < 0 || r > n) return NaN;
  return factorial(n) / factorial(n-r);
}

// ---- Memory functions ----
function memStore() { 
  memory = parseFloat(display.value) || 0; 
  document.getElementById('memIndicator').style.color = '#8f8';
}
function memRecall() { 
  if (memory !== 0) display.value = memory;
  else display.value = "0";
}
function memClear() { 
  memory = 0; 
  document.getElementById('memIndicator').style.color = '#6a748b';
}
function memAdd() { 
  let v = parseFloat(display.value) || 0;
  memory += v;
  document.getElementById('memIndicator').style.color = '#8f8';
}

// ---- Toggle DEG/RAD ----
function toggleMode() {
  degreeMode = !degreeMode;
  document.getElementById('modeLabel').innerText = degreeMode ? 'DEG' : 'RAD';
  document.getElementById('modeBtn').innerText = degreeMode ? 'DEG/RAD' : 'RAD/DEG';
}

// ---- Statistics (simple) ----
let statsData = [];
function statsMean() {
  let vals = prompt("Enter numbers separated by commas:", "1,2,3,4");
  if (!vals) return;
  statsData = vals.split(',').map(Number).filter(v => !isNaN(v));
  if (statsData.length === 0) return;
  let mean = statsData.reduce((a,b) => a+b, 0) / statsData.length;
  display.value = mean;
  lastAns = mean;
}
function statsSum() {
  if (statsData.length === 0) { statsMean(); return; }
  let sum = statsData.reduce((a,b) => a+b, 0);
  display.value = sum;
  lastAns = sum;
}
function statsVar() {
  if (statsData.length === 0) { statsMean(); return; }
  let mean = statsData.reduce((a,b) => a+b, 0) / statsData.length;
  let varian = statsData.reduce((a,b) => a + (b-mean)**2, 0) / statsData.length;
  display.value = varian;
  lastAns = varian;
}

// ---- Placeholder extended functions ----
function complexOp() { insert('+1i'); }
function matrixOp() { insert('[1,2;3,4]'); }
function derivativeOp() {
  let expr = prompt("Enter expression (e.g. x^2):", "x^2");
  if (expr) display.value = `d/dx(${expr})`;
}
function integralOp() {
  let expr = prompt("Enter expression (e.g. x^2):", "x^2");
  if (expr) display.value = `∫(${expr})`;
}
function fractionOp() {
  let num = prompt("Numerator:", "1");
  let den = prompt("Denominator:", "2");
  if (num && den) display.value = `(${num}/${den})`;
}

// ---- Keyboard support ----
document.addEventListener("keydown", function(e) {
  const key = e.key;
  if (["Enter","Backspace","Escape"].includes(key)) e.preventDefault();
  if (/^[0-9+\-*/().]$/.test(key)) insert(key);
  else if (key === "%") insert("%");
  else if (key === "Enter" || key === "=") calculate();
  else if (key === "Backspace") deleteLast();
  else if (key === "Escape") clearDisplay();
  else if (key === "e" || key === "E") insert("Math.E");
  else if (key === "p" || key === "P") insert("Math.PI");
  else if (key === "!") scientific('factorial');
  else if (key === "s") scientific('sin');
  else if (key === "c") scientific('cos');
  else if (key === "t") scientific('tan');
  else if (key === "l") scientific('log');
  else if (key === "n") scientific('ln');
  else if (key === "q") scientific('sqrt');
  else if (key === "^") insert("**");
  else if (key === "m") memStore();
  else if (key === "r") memRecall();
});

window.addEventListener('load', () => { display.focus(); });