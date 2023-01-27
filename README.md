## Getters & Setters ##

Let's face it. Getters and setters in PHP sucks. Instead of having getter and setter accessor methods for classes we instead have the `__get` and `__set` magic methods to handle all properties. Not only are they unwieldy to use when you have many properties they also become difficult to handle when inheriting, especially when traits are involved. This trait attempts to create hackish getter and setter methods that can be extended by simple inheritance.

This trait was originally called MagicProperties and was available in the `mensbeam/framework` package. That one has been discontinued.

This is a stub. Documentation is forthcoming.