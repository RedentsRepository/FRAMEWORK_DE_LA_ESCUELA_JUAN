<div id="nav-cart-box">
    <div id="nav-cart-group">
        <label id="nav-cart-label">0</label>
        <img src="~/Content/icon_cart.png" />
    </div>
</div>
<div class="article">
    <div class="article-container" id="${id}">
        <table>
            <tr>
                <td>
                    <div class="article-barcode-container">
                        <p>${id}</p>
                    </div>
                </td>
                <td>
                    <div class="article-image"><img src="data:image/png;base64,${image}" /></div>
                </td>
                <td>
                    <div class="article-number-count"><input id="ni_${id}" type="number" min="0" max="${maxcount}" onkeydown="return false" ></div>
                </td>
                <td>
                    <div class="article-details">
                        <p class="article-name">${name}</p><br />
                        <p class="article-price" style="text-decoration: line-through; color: red;">${price} € / Stück</p>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</div>


<div id="order-articles">
    <div id="order-articles-container">
    </div>
</div>

<div id="order-info">
    <div id="order-info-container">
        <h2>Das könnte dich interessieren!</h2>
        <div id="order-info-flex">
            <div uid="order-info-left">
                <p>TGW hat ca. 4200 Mitarbeiter weltweit.</p>
                <p>Wir bilden über 170 Lehrlinge aus!</p>
            </div>
            <div uid="order-info-right">
                <p>Wir haben viele verschiedene Lehrberufe: </p>
                <ul id="apprenticeships-list"></ul>
            </div>
        </div>
    </div>
</div>

<button class="js-toggle-fullscreen" style="position: fixed; bottom: 10px; left: 10px; width: 75px; border: none; background: none; " onmouseover="this.style.backgroundColor='#e8e8e8'" onmouseout="this.style.backgroundColor='white'"><img src="icon_fullscreen.png"></button>