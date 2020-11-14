#!/bin/bash

# @Author: Softbery(C)
# @Date:   2020-10-19 19:09:00
# @Last Modified by:   Softbery Group
# @Last Modified time: 2020-10-20 06:11:31

# NEW MODULE - A script to produce a new module for zend framework 3

##### Constants

TITLE="CREATE NEW MODULE"
RIGHT_NOW="$(date +"%x %r %Z")"
TIME_STAMP="Updated on $RIGHT_NOW by $USER"

##### Functions

new_module()
{
	cd module
	printf "Clonning repository ...\n"
	git clone git@bitbucket.org:zendframework3/zf3-module.git $module_name
	cd $module_name
	printf "Removing git file ...\n"
	rm -Rf .git .gitignore
	printf "Removing git remoting ...\n"
	git remote remove origin
	printf "Removing license file ...\n"
	rm LICENSE.md 
	printf "Removing readme file ...\n"
	rm README.md
	printf "Removing test/ folder ...\n"
	rm -R tests
	printf "Renameing ...\n"
	for php in $(find . -name '*.php');do
		sed --in-place -e 's/ZendSkeletonModule/'$module_name'/g' $php
	done
	for php in $(find . -name '*.php');do
		sed --in-place -e 's/SkeletonController/'${module_name}'Controller/g' $php
	done
	for php in $(find . -name '*.php');do
		sed --in-place -e 's/module-name-here/'${module_name,,}'/g' $php
	done
	for php in $(find . -name '*.php');do
		sed --in-place -e 's/module-specific-root/'${module_name,,}'/g' $php
	done
	printf "Setting controller file ...\n"
	mv src/Controller/SkeletonController.php src/Controller/${module_name}Controller.php
	printf "Setting view folder ...\n"
	mv view/zend-skeleton-module/ view/${module_name,,}/
	mv view/${module_name,,}/skeleton/ view/${module_name,,}/${module_name,,}/
	cd ..
	cd ..
	printf "Adding module to composer ...\n"
	for php in $(find . -name 'composer.json');do 
		sed -i -e 's/\"Application\\\\": \"module\/Application\/src\/\",/\"Application\\\\": \"module\/Application\/src\/\",\n\t\t\t\"'${module_name}'\\\\": \"module\/'${module_name}'\/src\/\",/g' $php; 
	done
	printf "Run dump autoload ...\n"
	composer dump-autoload
	cd config
	printf "Adding module to configuration ...\n"
	for php in $(find . -name 'modules.config.php');do 
		sed -i -e "s/\'Application\',/\'Application\',\n\t\t\'"${module_name}"\',/g" $php; 
	done
	printf "\nAll process is done."
}

delete_module()
{
	cd module
	if [[ -d "$module_name" ]]; then
		printf "Removing module "$module_name" ...\n"
		rm -R $module_name
		printf "\nModule was removed from Softbery(C)Cms System."
	else
		printf "Module: "$module_name" no exist\n"
	fi
}

usage()
{
	printf "Help:\n\n"
    printf "syntax: sbscript [[[-f file ] [-i]] | [-h]]\n"
    printf " \n"
}

##### Main

module_name="Module"

while [ "$1" != "" ]; do
    case $1 in
        -dm | --delete-module ) shift
								module_name=$1
								delete_module
                                ;;
        -m | --module )         shift
								module_name=$1
								new_module
                                ;;
        -h | --help )           usage
                                exit
                                ;;
        * )                     usage
                                exit 1
    esac
    shift
done