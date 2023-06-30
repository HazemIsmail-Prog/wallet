<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.js"
    integrity="sha512-BbVEDjbqdN3Eow8+empLMrJlxXRj5nEitiCAK5A1pUr66+jLVejo3PmjIaucRnjlB0P9R3rBUs3g5jXc8ti+fQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js"
integrity="sha512-iphNRh6dPbeuPGIrQbCdbBF/qcqadKWLa35YPVfMZMHBSI6PLJh1om2xCTWhpVpmUyb4IvVS9iYnnYMkleVXLA=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div wire:ignore class="w-full " id="calcu" x-data="{amount:@entangle('amount')}">
    <input disabled class=" bg-transparent border-0 text-xs dark:text-gray-400" x-model="amount" type="text" id="result">
    <div class="w-full h-52 flex">
        <div class=" flex-1 grid grid-cols-4 grid-rows-4 bg-white dark:text-gray-400 dark:bg-gray-700 rounded-xl overflow-clip dark:border-gray-900 divide-x divide-y dark:divide-gray-900 border">
            <div><input class="w-full h-full border-t border-l dark:border-gray-900" type="button" value="7" onclick="dis('7')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="8" onclick="dis('8')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="9" onclick="dis('9')" onkeydown="myFunction(event)"> </div>
            <div class="flex flex-col flex-3 row-span-3 items-center justify-evenly bg-gray-900 text-white dark:bg-indigo-900 dark:text-gray-400 divide-y dark:divide-gray-900">
                <div class="w-full h-full"><input class="w-full h-full text-2xl" type="button" value="÷" onclick="dis('/')" onkeydown="myFunction(event)"> </div>
                <div class="w-full h-full"><input class="w-full h-full text-2xl" type="button" value="×" onclick="dis('*')" onkeydown="myFunction(event)"> </div>
                <div class="w-full h-full"><input class="w-full h-full text-2xl" type="button" value="-" onclick="dis('-')" onkeydown="myFunction(event)"> </div>
                <div class="w-full h-full"><input class="w-full h-full text-2xl" type="button" value="+" onclick="dis('+')" onkeydown="myFunction(event)"> </div>
            </div>
            <div><input class="w-full h-full" type="button" value="4" onclick="dis('4')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="5" onclick="dis('5')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="6" onclick="dis('6')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="1" onclick="dis('1')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="2" onclick="dis('2')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="3" onclick="dis('3')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="." onclick="dis('.')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full" type="button" value="0" onclick="dis('0')" onkeydown="myFunction(event)"> </div>
            <div><input class="w-full h-full text-2xl bg-gray-900 text-white dark:bg-indigo-900 dark:text-gray-400" type="button" value="c" onclick="clr()" /> </div>
            <div><input class="w-full h-full text-2xl bg-gray-900 text-white dark:bg-indigo-900 dark:text-gray-400" type="button" value="=" onclick="solve()"> </div>
            
        </div>
    </div>

    <script>
        // Function that display value
        function dis(val) {
            document.getElementById("result").value += val
            // console.log(val);
        }

        function myFunction(event) {
            if (event.key == '0' || event.key == '1' ||
                event.key == '2' || event.key == '3' ||
                event.key == '4' || event.key == '5' ||
                event.key == '6' || event.key == '7' ||
                event.key == '8' || event.key == '9' ||
                event.key == '+' || event.key == '-' ||
                event.key == '*' || event.key == '/')
                document.getElementById("result").value += event.key;
        }

        var cal = document.getElementById("calcu");
        cal.onkeyup = function(event) {
            if (event.keyCode === 13) {
                console.log("Enter");
                let x = document.getElementById("result").value
                console.log(x);
                solve();
            }
        }

        // Function that evaluates the digit and return result
        function solve() {
            let x = document.getElementById("result").value
            let y = math.evaluate(x)
            document.getElementById("result").value = y
            console.log(y);
            @this.set('amount',y);
        }

        // Function that clear the display
        function clr() {
            document.getElementById("result").value = ""
        }
    </script>
</div>
