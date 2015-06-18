ipwiz
=====

Lookup IP and DNS information for a domain.

usage: ipwiz xxx

## Install using brew (recomended):

brew install https://raw.githubusercontent.com/wingsuitist/ipwiz/master/homebrew/ipwiz.rb

(It's not ready to put it in the global repository yet.)

## Installation with composer:

1. install composer
2. install ipwiz in some folder (ie scripts/ipwiz)
composer create-project -s dev wingsuitist/ipwiz ~/scripts/ipwiz dev-master
3. add directory to your bash profile:
~/.bash_profile


-- copy --

export PATH=~/scripts/ipwiz/bin/:$PATH

--paste --
