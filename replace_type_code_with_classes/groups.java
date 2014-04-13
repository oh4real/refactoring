//================ BEFORE

class Person {
	public static final int O = 0;
	public static final int A = 1;
	public static final int B = 2;
	public static final int AB = 3;

	private int _bloodGroup;

	public Person (int bloodGroup) {
		_bloodGroup = bloodGroup;
	}

	public void setBloodGroup(int arg) {
		_bloodGroup = arg;
	}

	public int getBloodGroup() {
		return _bloodGroup;
	}
}

Person thePerson = new Person(Person.A);
assert(thePerson.getBloodGroup() == 1);

thePerson.setBloodGroup(Person.O);
assert(thePerson.getBloodGroup() == 0);

//================= AFTER

class Person {
	// after refactor these are no longer stored here, but are in BloodGroup
	// public static final int O = BloodGroup.O.getCode();
	// public static final int A = BloodGroup.A.getCode();
	// public static final int B = BloodGroup.B.getCode();
	// public static final int AB = BloodGroup.AB.getCode();

	private BloodGroup _bloodGroup;

	public Person (BloodGroup bloodGroup) {
		_bloodGroup = bloodGroup;
	}

	public void setBloodGroup(int arg) {
		_bloodGroup = BloodGroup.code(arg);
	}

	public BloodGroup getBloodGroup() {
		return _bloodGroup;
	}

	public int getBloodGroupCode() {
		return _bloodGroup.getCode();
	}
}

class BloodGroup {
	public static final BloodGroup O = new BloodGroup(0);
	public static final BloodGroup A = new BloodGroup(1);
	public static final BloodGroup B = new BloodGroup(2);
	public static final BloodGroup AB = new BloodGroup(3);

	private static final BloodGroup[] _values = {O, A, B, AB};

	private final int _code;

	private BloodGroup (int code) {
		_code = code;
	}

	public int getCode() {
		return _code;
	}

	public static BloodGroup code(int arg) {
		return _values[arg];
	}

	// I think I need to add this
	public boolean equals(BloodGroup bloodGroup) {
		return _code == bloodGroup.getCode();
	}
}

Person thePerson = new Person(BloodGroup.A);
assert(thePerson.getBloodGroup().getCode() == 1);
assert(BloodGroup.A.equals(thePerson.getBloodGroup()));
assert(thePerson.getBloodGroupCode() == 1);


thePerson.setBloodGroup(BloodGroup.O);
assert(thePerson.getBloodGroup().getCode() == 0);
assert(BloodGroup.O.equals(thePerson.getBloodGroup()));
assert(thePerson.getBloodGroupCode() == 0);