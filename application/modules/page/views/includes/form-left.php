  
 <!-- =============== FORM ======================= -->

  <form  id="form_data">
      <span id="msg"></span>
      <h2>Numbers</h2>
      <div class="form-group">
        <label for="Number_One">Number One</label>
        <input type="text" name="num1" id="num1" class="form-control" placeholder="Enter number one" required>
      </div>

      <div class="form-group">
        <label for="Number_Two">Number Two</label>
        <input type="text" name="num2" id="num2" class="form-control" placeholder="Enter number two" required>
      </div>

      <div class="form-group">
        <label for="Operation">Operation</label>
        <select type="text" class="form-control" name="operand" id="operand" required>
          <option value="+">Add</option>
          <option value="-">Subtract</option>
          <option value="/">Devide</option>
          <option value="*">Multiply</option>
        </select>
      </div>
    
     <button class="btn" type="submit"> Post </button> 
  </form>

<!-- ===============/end: FORM ======================= -->
