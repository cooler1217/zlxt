file_object = open('../filename.txt')
try:
     all_the_text = file_object.readlines()
finally:
     file_object.close()
print all_the_text