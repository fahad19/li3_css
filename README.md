# li3\_css

Brings new features to your CSS files in Lithium framework. Currently works with Library assets only.

## Installation

Place li3\_css files under app/libraries/li3\_css directory, then add this line to app/config/bootstrap/libraries.php

    Libraries::add('li3\_css');


## Examples

### Selector Inheritance

    .round {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    
    #test-round {
        extend: .round;
    }

becomes

    .round {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }
    
    #test-round {
        -moz-border-radius: 5px;
        -webkit-border-radius: 5px;
        border-radius: 5px;
    }

The **extend** property may also contain multiple selectors separated by a comma.

## Credits

[CSS Parser](https://github.com/SirPepe/CSS-Parser) by Peter Kröner